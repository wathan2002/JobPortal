<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Comment;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return view('admin/news/index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news_categories = NewsCategory::all();
        return view('admin/news/create', compact('news_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg',
            'description'=>'required',
            'news_category_id'=>'required',
        ]);
        $image = $request->image;
        $imageName = uniqid().'_'. $image->getClientOriginalName();

        $image->storeAs('public/news-images',$imageName);

        News::create([
            'news_category_id'=>$request->news_category_id,
            'image'=>$imageName,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect('admin/news')->with('successMsg', 'You have successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comments = Comment::where('news_id', $id)->get();
        return view('admin/news/comment', compact('comments'));
    }

    public function showHideComment($id)
    {
        $comment = Comment::findOrFail($id);
        if($comment->status == 'show'){
            $comment->update([
                'status'=>'hide'
            ]); 
        }else{
            $comment->update([
                'status'=>'show'
            ]); 
        }
        return back()->with('successMsg', 'You have changed the status for this comment!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news_categories = NewsCategory::all();
        $new = News::find($id);
        return view('admin/news/edit', compact('news_categories', 'new'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'news_category_id'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,webp',
            'title'=>'required',
            'description'=>'required',
        ]);
        $new = News::find($id);
        if($request->hasFile('image'))
        {
            $newsimage = $new->image;
            File::delete('storage/news-images/'.$newsimage);
            $image = $request->image;
            $imageName = uniqid().'_'. $image->getClientOriginalName();

            $image->storeAs('public/news-images',$imageName);
            $new->update([
                'news_category_id'=>$request->news_category_id,
                'image'=>$imageName,
                'title'=>$request->title,
                'description'=>$request->description,
            ]);
        }
        $new->update([
            'news_category_id'=>$request->news_category_id,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        
        return redirect('admin/news')->with('successMsg', 'You have successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news= News::findOrfail($id);
        $news->delete();
        return redirect()->back()->with('successMsg', 'You have successfully deleted!');
    }
}
