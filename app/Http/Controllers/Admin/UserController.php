<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
	/**
	 * Display all users.
	 * 
	 * @return Illuminate\Foundation\Http\response
	 */
    public function index() {
    	$users = User::orderBy('id')->paginate(10);
    	return view('admin.user.index', compact('users'));
    }

    /**
     * Display the create user form.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function create() {
    	$groups = Group::all();
    	return view('admin.user.create', compact('groups'));
    }

    /**
     * Store and create the new user.
     * 
     * @param  Request $request 
     * @param  User    $user    
     * @return Illuminate\Foundation\Http\response           
     */
    public function store(Request $request, User $user) {
    	$this->validate($request, [
    		'username' => 'required|min:3|max:20|unique:users',
    		'password' => 'required|min:6|confirmed',
    		'email'    => 'required|email|unique:users'
    	]);

    	$user->create([
    		'username'	=> $request->username,
    		'password'	=> Hash::make($request->password),
    		'email'		=> $request->email,
    		'ip'		=> $_SERVER['REMOTE_ADDR']
    	]);

    	return redirect()->route('user.index');
    }

    /**
     * Display the edit user form.
     * 
     * @param  User   $user 
     * @return Illuminate\Foundation\Http\response       
     */
    public function edit(User $user) {
    	$groups = Group::all();
    	return view('admin.user.edit', compact('user', 'groups'));
    }

    /**
     * Update the details of the specified user.
     * 
     * @param  Request $request 
     * @param  User    $user    
     * @return Illuminate\Foundation\Http\response           
     */
    public function update(Request $request, User $user) {
    	$this->validate($request, [
    		'username' 	=> 'required|min:3|max:255|unique:users,username,'.Auth::id(),
    		'password' 	=> 'min:6',
    		'email'		=> 'required|email|unique:users,email,'.Auth::id(),
    		'group'		=> 'exists:groups,id',
    		'title'		=> 'max:255',
    		'first_name'=> 'alpha|max:30',
    		'last_name'	=> 'alpha|max:30',
    		'location'	=> 'max:30',
    		'sex'		=> 'in:none,male,female',
    		'about'		=> 'max:60',
    		'signature' => 'max:400'
    	]);

    	$user->update([
    		'username' 	=> $request->username,
    		'password' 	=> Hash::make($request->password),
    		'email'		=> $request->email,
    		'group_id'	=> $request->group,
    		'title'		=> $request->title,
    		'first_name'=> $request->first_name,
    		'last_name'	=> $request->last_name,
    		'location'	=> $request->location,
    		'sex'		=> $request->sex,
    		'about'		=> $request->about,
    		'signature' => $request->signature
    	]);

    	return back();
    }

    /**
     * Delete the specified user.
     * 
     * @param  User   $user
     * @return Illuminate\Foundation\Http\response
     */
    public function destroy(User $user) {
    	$user->delete();
        Redis::del('user.'.$user->id.'.views');

    	return back();
    }
}
