<?php

namespace App;

trait Friendship {
    /**
     * Show all my friends and friend request.
     * 
     * @return Illuminate\Database\Eloquent\belongsToMany
     */
    public function friendsOfMine() {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->withTimestamps();
    }

    /**
     * Show all the friends and friend request of choosen user.
     * 
     * @return Illuminate\Database\Eloquent\belongsToMany
     */
    public function friendsOf() {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withTimestamps();
    }

    /**
     * Show all user friends that has been accepted by both sides.
     * 
     * @return Illuminate\Database\Eloquent\belongsToMany
     */
    public function friends() {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
           ->merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }   

    /**
     * Friend request that sent to me and hasn't been approoved yet.
     * 
     * @return Illuminate\Database\Eloquent\belongsToMany
     */
    public function friendRequests() {
        return $this->friendsOfMine()->whereAccepted(false)->get();
    }


    /**
     * Friend requests that I sent and hasn't been approoved yet.
     * 
     * @return Illuminate\Database\Eloquent\belongsToMany
     */
    public function friendRequestsPending() {
        return $this->friendsOf()->whereAccepted(false)->get();
    }

    /**
     * 
     * @param  User    $user
     * @return boolean       
     */
    public function hasFriendRequestPending(User $user) {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user) {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    /**
     * Attaching the two users.
     * 
     * @param User $user
     */
    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    /**
     * Detaching the users.
     * 
     * @param  User   $user 
     * @return void
     */
    public function cancelFriendRequest(User $user) {
        $this->friendsOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);        
    }

    /**
     * Accepting the friend request.
     * 
     * @param  User   $user
     * @return Illuminate\Database\Eloquent\belongsToMany
     */
    public function acceptFriendRequest(User $user) {
        return $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true,
        ]);
    }

    /**
     * Check if the authanticated user is friend with the given user.
     * 
     * @param  User    $user
     * @return boolean
     */
    public function isFriendWith(User $user) {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }	
}