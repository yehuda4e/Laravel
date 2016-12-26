<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Friendship;

    /**
     * This is the attributes that are not mass assimante.
     * 
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function topics() {
        return $this->hasMany(Topic::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function statuses() {
        return $this->hasMany(Status::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function hasLiked(Model $model) {
        return (bool) $model->likes->where('user_id', $this->id)->count();
    }


    /**
     * Check if the user has admin panel authorization.
     * 
     * @return boolean 
     */
    public function isAdmin() {
        return (json_decode($this->group->permissions))->admin;
    }

    public function can($index, $key = null) {
        $permission = json_decode($this->group->permissions);

        if (isset($key) && isset($index)) {
            return $permission->{$index}->{$key};
        }

        return $permission->{$index};   
    }

    /**
     * Check if user assign name, and if so display it.
     * 
     * @return string|boolean [if the user assign first name of last name it'll show it. If not false will return]
     */
    public function name() {
        if ($this->first_name && $this->last_name) {
            return $this->first_name.' '.$this->last_name;
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return false;
    }

    /**
     * Display link to user profile with the group style.
     *
     * @param string $username [for custom text or profile img]
     * @return string
     */
    public function profile($username = null) {
        return '<a href="'.url('user/'.$this->id.'/'.$this->username).'" style="color:'.$this->group->color.'">'.($username ?? $this->username).'</a>';
    }

    /**
     * Display the user avatar.
     * 
     * @param  string $classes [add classes to the img if necessary]
     * @param  string $style [custum style]
     * @return string          [avatar images]
     */
    public function getAvatar($classes = '', $style = '') {
        // If the user havent set yet his profile picure, then we use his Gravatar avatar. 
        // And if he dosnt have a Gravatar avatar, then Gravatar genarate him a new one.
        return ($this->avatar) ?
            '<img src="'.$this->avatar.'" alt="'.$this->username.'" class="'.$classes.'" style="'.$style.'">' :
            '<img src="https://www.gravatar.com/avatar/'.md5($this->email).'?d=retro&s=160" alt="'.$this->username.'" class="'.$classes.'" style="'.$style.'">';        
    }

}
