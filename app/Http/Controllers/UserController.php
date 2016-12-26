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

    /**
     * Display the specified user.
     *  
     * @param  User   $user 
     * @return Illuminate\Foundation\Http\response
     */
    public function show(User $user) {
    	return view('user.show', compact('user'));
    }

    public function add($username) {
        $user = User::whereUsername($username)->first();
        if (!$user) {
            return redirect('/')->with('info', 'User not found.');
        }

        if ($this->user->hasFriendRequestPending($user) || $user->hasFriendRequestPending($this->user)) {
            return redirect('/')->with('info', 'Friend request already pending.');
        }

        if ($this->user->isFriendWith($user)) {
            return redirect('/')->with('info', 'Your already friends');
        }

        if ($user->id === $this->user->id) {
            return redirect('/')->with('info', 'You can\'t send friend request to yourself.');
        }

        $this->user->addFriend($user);
        return back()->with('info', 'Friend request sent.');
    }

    public function acceptFriend($username) {
        $user = User::whereUsername($username)->first();

        if (!$user) {
            return redirect('/')->with('info', 'User not found.');
        }

        if (!$this->user->hasFriendRequestReceived($user)) {
            return back();
        }

        $this->user->acceptFriendRequest($user);
        return back()->with('info', 'Friend request accepted.');       
    }

    public function cancelFriendRequest($username) {
        $user = User::whereUsername($username)->first();

        if (!$user) {
            return redirect('/')->with('info', 'User not found.');
        }

        $this->user->cancelFriendRequest($user);
        return back()->with('info', 'Friend request canceled.');
    }

    /**
     * Display the general settings form.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function general() {
    	return view('user.settings.general', ['user' => $this->user]);
    }

    /**
     * Update the general settings form.
     * 
     * @param  Request $request 
     * @return Illuminate\Foundation\Http\response
     */
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

    /**
     * Display the avatar form.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function avatar() {
        return view('user.settings.avatar', ['user' => $this->user]);
    }

    /**
     * Update the avatar.
     * 
     * @param  Request $request
     * @return Illuminate\Foundation\Http\response
     */
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

    /**
     * Display the change password form.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function password() {
         return view('user.settings.password', ['user' => $this->user]);
     } 

     /**
      * Update and chnage the password.
      * 
      * @param  Request $request 
      * @return Illuminate\Foundation\Http\response
      */
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

    /**
     * Display the signature page.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function signature() {
        return view('user.settings.signature', ['user' => $this->user]);
    }

    /**
     * Update the signature.
     * 
     * @param  Request $request
     * @return Illuminate\Foundation\Http\response
     */
    public function updateSign(Request $request) {
        $this->user->update(['signature' => $request->signature]);
        return back();
    }
}
