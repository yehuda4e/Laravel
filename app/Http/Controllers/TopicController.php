<?php

namespace App\Http\Controllers;

use App\Notifications\ResourceCommented;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TopicController extends Controller
{
	public function __construct() {
        parent::__construct();
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
     * Change the topic state close/open/pin/delete.
     * 
     * @param  Request $request 
     * @param  Topic   $topic   
     * @return Illuminate\Foundation\Http\response
     */
    public function changeState(Request $request, Topic $topic) {
        foreach ($request->options as $option) {
            switch ($option) {
                case 'close':
                    $topic->lock = true;
                    $topic->save(); 
                    break;
                case 'open':
                    $topic->lock = false;
                    $topic->save();              
                    break;
                case 'pin':
                    $topic->pinned = true;
                    $topic->save(); 
                    break;
                case 'unpin':
                    $topic->pinned = false;
                    $topic->save(); 
                    break;
                case 'delete':
                    $this->destory($topic);
                    break;
            }
        }


        return redirect('forum/'.$topic->forum->id.'/'.urlencode($topic->forum->name));
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
            'user_id'   => $this->user->id
        ]);

        // Every time someone post a comment, 
        // update the topic 'updated_at' column for sorting the last comment on the main forum page.
        $topic->updated_at = Carbon::now();
        $topic->save();

        if ($topic->user->id !== auth()->id()) {
            $topic->user->notify(new ResourceCommented($topic));
        }

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
            'subject'   => 'required|min:3|max:255',
            'content'   => 'required|min:3'
        ]);

        $topic = new Topic;
        $topic->subject = $request->subject;
        $topic->content = $request->content;
        $topic->user_id = $this->user->id;
        $topic->forum_id = $forumId;
        $topic->save();

        return redirect()->route('topic.show', $topic);
    }

    /**
     * Delete the specified topic.
     * 
     * @param  Topic  $topic
     * @return Illuminate\Foundation\Http\response
     */
    public function destroy(Topic $topic) {
        $topic->delete();
        Redis::del('topic.'.$topic->id.'.views');
        
    }
}
