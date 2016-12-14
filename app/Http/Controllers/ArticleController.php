<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function __construct() {
        parent::__construct();
		$this->middleware('auth', ['only' => 'comment']);
	}

    /**
     * Show the main page.
     * 
     * @return Illuminate\Foundation\Http\response
     */
	public function index() {
		$articles = Article::latest()->paginate();
		return view('article.index', compact('articles'));
	}

    /**
     * Show the article.
     * 
     * @param  string $slug [the article slug]
     * @return Illuminate\Foundation\Http\response
     */
    public function show($slug) {
    	$article = Article::whereSlug(urldecode($slug))->first();
    	if ($article) {
            $this->incr("article", $article->id); 
	    	return view('article.show', compact('article'));
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
        $category = Category::whereName($name)->with('articles')->first();

        return view('article.category', compact('category'));
    }

    /**
     * Display all the articles that containe the specified tag.
     * 
     * @param  string $tag [tag name]
     * @return Illuminate\Foundation\Http\response
     */
    public function tag($tag) {
        $articles = Article::where('tags', 'like', "%{$tag}%")->paginate(10);

        return view('article.tag', compact('articles', 'tag'));
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
    		'user_id'	=> $this->user->id
    	]);

    	return back();
    }

}