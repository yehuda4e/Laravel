<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
	public function __construct() {
		$this->middleware('auth', ['only' => 'comment']);
	}

    /**
     * Show the main page.
     * 
     * @return Illuminate\Foundation\Http\response
     */
	public function index() {
		$articles = Article::latest()->paginate();
        // Select all the categories except the first one,
        // because it the news category, and it shouldn't be shown on the main page.
		$categories = Category::where('id', '!=', 1)->get();
		return view('article.index', compact('articles', 'categories'));
	}

    /**
     * Show the article.
     * 
     * @param  string $slug [the article slug]
     * @return Illuminate\Foundation\Http\response|Exeption
     */
    public function show($slug) {
    	$categories = Category::where('id', '!=', 1)->get();
    	$article = Article::whereSlug($slug)->first();
    	if ($article) {
	    	Redis::incr("article.$article->id.views");
	    	return view('article.show', compact('article', 'categories'));
	    }
	    return abort(404);
    }

    /**
     * Comment on the article.
     * 
     * @param  Request $request 
     * @param  Article $article 
     * @return null
     */
    public function comment(Request $request, Article $article) {
    	$this->validate($request, [
    		'comment' => 'required'
    	]);

    	$article->comments()->create([
    		'body' 		=> $request->comment,
    		'user_id'	=> Auth::id()
    	]);

    	return back();
    }

}