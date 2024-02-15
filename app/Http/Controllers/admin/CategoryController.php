<?php

namespace App\Http\Controllers\admin;

use App\Models\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = category::all();
        $request->validate([
            'name'=>"required|unique:categories",
        ]);
        category::create([
            'name'=>$request->name,
        ]);
        return redirect('admin/categories')->with('successMsg', 'You have successfully created!');
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
        $category = category::findOrfail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = category::findOrfail($id);
        $category->update([
            'name'=>$request->name,
        ]);
        return redirect('admin/categories')->with('successMsg', 'You have successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = category::findOrfail($id);
        $category->delete();
        return redirect('admin/categories')->with('successMsg', 'You have successfully deleted!');
    }
}
