<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function name() {
        if ($this->first_name && $this->last_name) {
            return $this->first_name.' '.$this->last_name;
        }
        elseif ($this->first_name) {
            return $this->first_name;
        }
        elseif ($this->last_name) {
            return $this->last_name;
        }

        return false;
    }

    public function profile() {
        return '<a href="'.url('user/'.$this->id.'/'.$this->username).'" style="color:'.$this->group->color.'">'.$this->username.'</a>';
    }

    public function getAvatar($classes = '') {
        // If the user havent set yet his profile picure, then we use his Gravatar avatar. 
        // And if he dosnt have a Gravatar avatar, then Gravatar genarate him a new one.
        return ($this->avatar) ?
            '<img src="'.$this->avatar.'" alt="'.$this->username.'" class="'.$classes.'">' :
            '<img src="https://www.gravatar.com/avatar/'.md5($this->email).'?d=retro&s=160" alt="'.$this->username.'" class="'.$classes.'">';        
    }
}
