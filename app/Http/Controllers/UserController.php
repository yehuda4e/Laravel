<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->middleware('auth', ['exept' => 'show']);
    }

    public function show(User $user) {
    	return view('user.show', compact('user'));
    }

    public function general() {
    	return view('user.settings.general', ['user' => $this->user]);
    }

    public function update(Request $request) {
    	$this->validate($request, [
    		'first_name' => 'alpha',
    		'last_name'	 => 'alpha',
    		'location'	 => 'max:30',
    		'about'		 => 'max:120',
    		'sex'		 => 'in:none,male,female'
    	]);

    	$this->user->update([
    		'first_name' => $request->first_name,
    		'last_name'	 => $request->last_name,
    		'location'	 => $request->location,
    		'about'		 => $request->about,
    		'sex'		 => $request->sex,   		
    	]);

    	return back();
    }

    public function avatar() {
        return view('user.settings.avatar', ['user' => $this->user]);
    }

    public function updateAvatar(Request $request) {
        $this->validate($request, [
            'avatar' => 'active_url',
            'cover' => 'active_url'
        ]);

        $this->user->update([
            'avatar' => $request->avatar,
            'cover' => $request->cover
        ]);

        return back();
    }  

    public function password() {
         return view('user.settings.password', ['user' => $this->user]);
     } 

     public function updatePassword(Request $request) {
        $this->validate($request, [
            'old_password'  => 'required',
            'password'      => 'required|confirmed|min:6|different:old_password',
        ]);

        if (!Hash::check($request->old_password, $this->user->password))
        {
            return back()->withErrors('pass wrong');
        }

        $this->user->update(['password' => bcrypt($request->password)]);
        return back();
     }

     public function signature() {
         return view('user.settings.signature', ['user' => $this->user]);
     }

     public function updateSign(Request $request) {
         $this->user->update(['signature' => $request->signature]);
         return back();
     }
}
