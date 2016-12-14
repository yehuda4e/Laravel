<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller {

	/**
	 * Search users by the username of first/last name and display it.
	 * 
	 * @param  Request $request 
	 * @return Illuminate\Foundation\Http\response           
	 */
	public function results(Request $request) {
		// The search query
		$user = $request->q;

		if (!$user) {
			return redirect('/');
		}

		$users = User::where(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$user}%")
					->orWhere('username', 'like', "%{$user}%")
					->get();

		return view('search.results', compact('users'));
	}

}