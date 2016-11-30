<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['subject', 'content', 'user_id', 'forum_id'];

    public $perPage = 10;

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function forum() {
    	return $this->belongsTo(Forum::class);
    }

    public function comments() {
    	return $this->morphMany(Comment::class, 'commentable');
    }

/*    public function latest() {
        return ($this->comments->count() > 0) ? 'sdf' : '$this->path()';
    }*/

    public function lastReply() {
        return ($this->comments->count() > 0) ? $this->comments->sortByDesc('created_at')->first() : $this;
    }   


}
