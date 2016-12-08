<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	/**
	 * Display all categories.
	 * 
	 * @return Illuminate\Foundation\Http\response
	 */
    public function index() {
    	$categories = Category::paginate(10);
    	return view('admin.category.index', compact('categories'));
    }

    /**
     * Display the create category form.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function create() {
    	return view('admin.category.create');
    }

    /**
     * Store and create new category.
     * @param  Request  $request  
     * @param  Category $category 
     * @return Illuminate\Foundation\Http\response             
     */
    public function store(Request $request, Category $category) {
    	$this->validate($request, [
    		'name' => 'required|min:3|max:255|unique:categories'
    	]);

    	$category->create([
    		'name' => $request->name
    	]);

    	return redirect()->route('category.index');
    }

    /**
     * Display the edit form.
     * 
     * @param  Category $category 
     * @return Illuminate\Foundation\Http\response             
     */
    public function edit(Category $category) {
    	return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified category.
     * 
     * @param  Request  $request  
     * @param  Category $category 
     * @return Illuminate\Foundation\Http\response             
     */
    public function update(Request $request, Category $category) {
    	$this->validate($request, [
    		'name' => 'required|min:3|max:255|unique:categories,name,'.$category->id
    	]);

    	$category->update([
    		'name' => $request->name
    	]); 

    	return back();   	
    }

    /**
     * Delete the specified category.
     * 
     * @param  Category $category 
     * @return Illuminate\Foundation\Http\response             
     */
    public function destroy(Category $category) {
    	// Category num 1 is the news category.
    	if ($category->id == 1) {
    		return back()->with('error', 'You can\'t delete this category');
    	}
    	$category->delete();

    	return back();
    }
}
