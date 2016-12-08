<?php

namespace App\Http\Controllers\Admin;

use App\ForumCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumCategoryController extends Controller
{
	/**
	 * Display all forum categories.
	 * 
	 * @return Illuminate\Foundation\Http\response
	 */
    public function index() {
    	$categories = ForumCategory::paginate(10);

    	return view('admin.forum.category.index', compact('categories'));
    }

    /**
     * Display the create form.
     * 
     * @return Illuminate\Foundation\Http\response 
     */
    public function create() {
    	return view('admin.forum.category.create');
    }

    /**
     * Store and create new forum category.
     * 
     * @param  Request       $request  
     * @param  ForumCategory $forumcat 
     * @return Illuminate\Foundation\Http\response                  
     */
    public function store(Request $request, ForumCategory $forumcat) {
    	$this->validate($request, [
    		'name'	=> 'required|min:2|max:255|unique:forum_categories,name,'.$forumcat->id,
    	]);

    	$forumcat->create([
    		'name'	=> $request->name
    	]);

    	return redirect()->route('forumcat.index');    	
    }

    /**
     * Display the edit form.
     * 
     * @param  ForumCategory $forumcat 
     * @return Illuminate\Foundation\Http\response                  
     */
    public function edit(ForumCategory $forumcat) {
    	return view('admin.forum.category.edit')->withCategory($forumcat);
    }

    /**
     * Update the specified forum cateegory.
     * 
     * @param  Request       $request  
     * @param  ForumCategory $forumcat 
     * @return Illuminate\Foundation\Http\response                  
     */
    public function update(Request $request, ForumCategory $forumcat) {
    	$this->validate($request, [
    		'name'	=> 'required|min:2|max:255|unique:forum_categories,name,'.$forumcat->id,
    	]);

    	$forumcat->update([
    		'name'	=> $request->name
    	]);

    	return back();
    }

    /**
     * Delete the specified forum category.
     * 
     * @param  ForumCategory $forumcat 
     * @return Illuminate\Foundation\Http\response                  
     */
    public function destroy(ForumCategory $forumcat) {
    	$forumcat->delete();

    	return back();
    }
}
