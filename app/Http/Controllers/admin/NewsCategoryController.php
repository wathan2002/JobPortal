<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsCategories = NewsCategory::all();
        return view('admin.news-category.index', compact('newsCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        NewsCategory::create([
            'name'=>$request->name,
        ]);
        return redirect('admin/newsCategories')->with('successMsg', 'You have successfully updated!');
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
        $newsCategory = NewsCategory::find($id);
        return view('admin.news-category.edit', compact('newsCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $newsCategory = NewsCategory::findOrfail($id);
        $newsCategory->update([
            'name'=>$request->name,
        ]);
        return redirect('admin/newsCategories')->with('successMsg', 'You have successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsCategory = NewsCategory::findOrfail($id);
        $newsCategory->delete();
        return redirect()->back()->with('successMsg', 'You have successfully deleted!');
    }
}
