<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all(); // Fetch all tags
        return view('backend.categories.index', compact('categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all(); // Fetch all tags for the create view
        return view('backend.categories.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'array', // Validate tags as an array
        ]);

        $category = Category::create($request->only('title'));
        $category->tags()->attach($request->tags); // Attach tags

        return redirect()->route('categories.index')->with('status', 'Category created successfully!');
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
    public function edit(Category $category)
    {
        $tags = Tag::all(); // Fetch all tags for the edit view
        return view('backend.categories.edit', compact('category', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'tags' => 'array', // Validate tags as an array
         ]);

         $category = Category::findOrFail($id);
         $category->title = $request->title;
         $category->save();
         $category->tags()->sync($request->tags); // Sync tags

         return redirect()->route('categories.index')->with('status', 'Category updated successfully!');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Category deleted successfully!');
    }

}
