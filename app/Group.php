<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = ['name', 'color', 'permissions'];
    public $timestamps = false;

    public function user() {
    	return $this->hasMany(User::class);
    }
}
