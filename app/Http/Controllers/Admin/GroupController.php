<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
	/**
	 * Display all the user groups.
	 * 
	 * @return Illuminate\Http\Response
	 */
    public function index() {
    	$groups = Group::paginate(10);
    	return view('admin.group.index', compact('groups'));
    }

    public function create() {
    	return view('admin.group.create');
    }
}
