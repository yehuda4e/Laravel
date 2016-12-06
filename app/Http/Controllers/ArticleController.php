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
     * @return Illuminate\Foundation\Http\response
     */
    public function show($slug) {
    	$categories = Category::where('id', '!=', 1)->get();
    	$article = Article::whereSlug(urldecode($slug))->first();
    	if ($article) {
            $this->incr("article", $article->id); 
	    	return view('article.show', compact('article', 'categories'));
	    }
	    return abort(404);
    }

    /**
     * Display the specified category with the articles that associated with it.
     * 
     * @param  string $name [category name]
     * @return Illuminate\Foundation\Http\response
     */
    public function category($name) {
        $categories = Category::where('id', '!=', 1)->get();
        $category = Category::whereName($name)->with('articles')->first();

        return view('article.category', compact('category', 'categories'));
    }

    /**
     * Display all the articles that containe the specified tag.
     * 
     * @param  string $tag [tag name]
     * @return Illuminate\Foundation\Http\response
     */
    public function tag($tag) {
        $categories = Category::where('id', '!=', 1)->get();
        $articles = Article::where('tags', 'like', "%{$tag}%")->paginate(10);

        return view('article.tag', compact('articles', 'categories', 'tag'));
    }

    /**
     * Comment on the article.
     * 
     * @param  Request $request 
     * @param  Article $article 
     * @return Illuminate\Foundation\Http\response
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