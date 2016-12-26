<?php
namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class TimelineController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		$statuses = Status::where(function($query) {
			return $query->where('user_id', auth()->id())
						->orWhereIn('user_id', auth()->user()->friends()->pluck('id'));
		})->orderBy('created_at', 'desc')->paginate(10);

		return view('timeline.index', compact('statuses'));
	}
}