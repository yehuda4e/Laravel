<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumCategory;
use Illuminate\Http\Request;

class ForumController extends Controller
{
	/**
	 * Show the main forum page.
	 * 
	 * @return Illuminate\Foundation\Http\response
	 */
    public function index() {
    	$categories = ForumCategory::with('forums.topics.comments')->get();
    	return view('forum.index', compact('categories'));
    }

    /**
     * Show forum.
     * @param  Forum  $forum 
     * @return Illuminate\Foundation\Http\response
     */
    public function show(Forum $forum) {
    	$forum->with('topics')->paginate();
    	return view('forum.show', compact('forum'));
    }
}
