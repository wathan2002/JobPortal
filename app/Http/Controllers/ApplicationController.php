<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\category;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function apply($id)
    {
        $job = Job::findOrfail($id);
        return view('ui_panel.application', compact('job'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'email'=>"required",
            'address'=>"required",
            'mobile'=>"required",
            'salary'=>"required|numeric",
            'job_id'=>"required",
            'employee_id'=>"required",
            'gender'=>"required",
            'image'=>'required|image|mimes:png,jpg,jpeg,webp',
        ]);
        $image = $request->image;
        $imageName = uniqid().'_'. $image->getClientOriginalName();

        $image->storeAs('public/application-images',$imageName);

        Application::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'address'=>$request->address,
            'mobile'=>$request->mobile,
            'salary'=>$request->salary,
            'job_id'=>$request->job_id,
            'employee_id'=>$request->employee_id,
            'gender'=>$request->gender,
            'image'=>$imageName,
        ]);
        return redirect('/');
    }
}
