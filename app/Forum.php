<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{

	protected $fillable = ['name', 'description', 'category'];

    public function cat() {
    	return $this->belongsTo(ForumCategory::class, 'category');
    }

    public function topics() {
    	return $this->hasMany(Topic::class);
    }

    public function comments() {
    	return $this->hasManyThrough(Comment::class, Topic::class, 'forum_id', 'commentable_id')->where('comments.commentable_type', 'App\Topic');
    }

    /**
     * show the last comment details of each forum.
     */
    public function last() {
        // 
        $topic = ($this->topics->sortByDesc('created_at')->first()) ?: false;
        $comment = ($this->comments->sortByDesc('created_at')->first()) ?: false;

        if ($topic !== false AND $comment !== false) {
            return ($topic->created_at > $comment->created_at) ? $topic : $comment;
        }
        elseif ($topic !== false AND $comment === false) {
            return $topic;
        }

        return false;
    }

    public function subjectOrComment() {
        // Check if the last comment is topic
        if ($this->last() == $this->topics->sortByDesc('created_at')->first()) {
            return $this->last();
        }
        else {
            return $this->last()->commentable;
        }
    }    
}
