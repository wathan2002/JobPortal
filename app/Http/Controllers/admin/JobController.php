<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\category;
use App\Models\Job;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::where('employer_id', Auth::user()->id)->get();
        return view('admin.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.job.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => "required",
            'employer_id'=>"required",
            'category_id' => "required",
            'description' => "required",
            'salary' => 'required|numeric',
        ]);
        $jobs = Job::all();
        Job::create([
            'title' => $request->title,
            'employer_id'=>$request->employer_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'salary' => $request->salary,
        ]);
        return redirect('admin/jobs')->with('successMsg', 'you have successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::findOrFail($id);
        $categories = category::all();
        return view('admin.job.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => "required",
            'category_id' => "required",
            'description' => "required",
            'salary' => 'required',
        ]);
        $job = Job::findOrfail($id);
        $job->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'salary' => $request->salary,
        ]);
        return redirect('admin/jobs')->with('successMsg', 'you have successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrfail($id);
        $job->delete();
        return redirect('admin/jobs')->with('successMsg', 'you have successfully deleted!');
    }

    //Show Application
    public function cv($id)
    {
        $job = Job::findOrfail($id);
        return view('admin.job.cv', compact('job'));
    }

    //Accept Application
    public function acceptApplication(Request $request, $id)
    {
        $application = Application::findOrfail($id);
        $application->update([
            'accept'=>1,
        ]);

        $message = Message::where('application_id', $application->id)->first();
        if($message){
            $message->update([
                'job_id'=>$request->job_id,
                'employer_id'=>$request->employer_id,
                'employee_id'=>$request->employee_id,
                'application_id'=>$request->application_id,
                'message'=>$request->message,
                'accept'=>$application->accept,
            ]);
        }else{
            Message::create([
                'job_id'=>$request->job_id,
                'employer_id'=>$request->employer_id,
                'employee_id'=>$request->employee_id,
                'application_id'=>$request->application_id,
                'message'=>$request->message,
                'accept'=>$application->accept,
            ]);
        };

        return back()->with('successMsg', 'You have sent the letter!');
    }

    public function rejectApplication(Request $request, $id)
    {
        $messages = Message::all();
        $application = Application::findOrfail($id);
        $application->update([
            'accept'=>0,
        ]);

        $message = Message::where('application_id', $application->id)->first();
        if($message){
            $message->update([
                'job_id'=>$request->job_id,
                'employer_id'=>$request->employer_id,
                'employee_id'=>$request->employee_id,
                'application_id'=>$request->application_id,
                'accept'=>$application->accept,
                'message'=>'Sorry, You are rejected!',
            ]);
        }else{
            Message::create([
                'job_id'=>$request->job_id,
                'employer_id'=>$request->employer_id,
                'employee_id'=>$request->employee_id,
                'application_id'=>$request->application_id,
                'accept'=>$application->accept,
                'message'=>'Sorry, You are rejected!',
            ]);
        };

        return back()->with('Fail', 'You have rejected this application!');
    }

}
