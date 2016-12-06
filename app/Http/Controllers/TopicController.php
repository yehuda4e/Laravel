<?php

namespace App\Http\Controllers;

use Auth;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TopicController extends Controller
{
	public function __construct() {
		$this->middleware('auth', ['only' => ['comment', 'create']]);
	}

    /**
     * Show the specified topic.
     *    
     * @param  Topic  $topic 
     * @return Illuminate\Foundation\Http\response 
     */
    public function show(Topic $topic) {
    	$this->incr("topic", $topic->id);
    	return view('topic.show', compact('topic'));
    }

    /**
     * Comment on the topic.
     * @param  Request $request
     * @param  Topic   $topic
     * @return Illuminate\Foundation\Http\response           
     */
    public function comment(Request $request, Topic $topic) {
    	$this->validate($request, [
    		'comment' => 'required'
    	]);

        $topic->comments()->create([
            'body'      => $request->comment,
            'user_id'   => Auth::id()
        ]);

        // Every time someone post a comment, 
        // update the topic 'updated_at' column for sorting the last comment on the main forum page.
        $topic->updated_at = Carbon::now();
        $topic->save();

    	return back();
    }

    /**
     * Create a topic.
     * 
     * @param  int $id [forum id]
     * @return Illuminate\Foundation\Http\response
     */
    public function create($id) {
        return view('topic.create', compact('id'));
    }

    /**
     * Store the topic.
     * 
     * @param  int  $forumId [forum ID]
     * @param  Request $request 
     * @return Illuminate\Foundation\Http\response 
     */
    public function store($forumId, Request $request) {
        $this->validate($request, [
            'subject'   => 'required|min:3|max:30',
            'content'   => 'required|min:3'
        ]);

        $topic = new Topic;
        $topic->subject = $request->subject;
        $topic->content = $request->content;
        $topic->user_id = Auth::id();
        $topic->forum_id = $forumId;
        $topic->save();

        return redirect('topic/'.$topic->id.'/'.$topic->subject);
    }

    /**
     * Delete the specified topic.
     * 
     * @param  Topic  $topic
     * @return Illuminate\Foundation\Http\response
     */
    public function destroy(Topic $topic) {
        // $topic->delete();
        // Redis::del('topic.'.$topic->id.'.views');
        // 
        // return redirect('forum/'.$topic->forum->id.'/'.urlencode($topic->forum->name));
    }
}
