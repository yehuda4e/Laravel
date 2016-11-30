<?php

namespace App\Http\Controllers;

use App\ForumCategory;
use Illuminate\Http\Request;

class ForumCategoryController extends Controller
{
	/**
	 * Show the forum category.
	 * @param  ForumCategory $category
	 * @return Illuminate\Foundation\Http\response                
	 */
    public function show(ForumCategory $category) {
    	return view('forum.category', compact('category'));
    }
}
