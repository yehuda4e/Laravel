<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentController extends Controller 
{
	public function __construct() {
		$this->middleware('auth');
	}

	public function like(Comment $comment) {

		if (auth()->user()->hasLiked($comment)) {
			return back();
		}

		$comment->likes()->create([
			'user_id' => auth()->id(),
		]);

		return back();
	}

	public function unlike(Comment $comment) {
		$comment->likes()->delete();

		return back();
	}
}