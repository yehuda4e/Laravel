<?php

namespace App\Http\Controllers;

use App\Like;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller 
{

	public function __construct() {
		$this->middleware('auth');
	}

	public function store(Request $request) {
		$this->validate($request, [
			'status' => 'required|min:2|max:255'
		]);

		auth()->user()->statuses()->create([
			'content' => $request->status,
		]);

		return back();
	}

	public function comment(Status $status, Request $request) {
		$this->validate($request, [
			"body-{$status->id}"	=> 'required'
		]);

		$status->comments()->create([
			'body'		=> $request->input("body-{$status->id}"),
			'user_id'	=> auth()->id(),
		]);

		return back();
	}	

	public function like(Status $status) {
		if (auth()->user()->hasLiked($status)) {
			return back();
		}

		$status->likes()->create([
			'user_id' => auth()->id(),
		]);

		return back();
	}

	public function unlike(Status $status) {
		$status->likes()->delete();

		return back();
	}

}