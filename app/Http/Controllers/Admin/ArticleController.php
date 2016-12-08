<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
	public function __construct() {
		parent::__construct();
	}
	/**
	 * Dispaly all the articles.
	 * 
	 * @return Illuminate\Foundation\Http\response
	 */
    public function index() {
    	$articles = Article::orderBy('id')->paginate(10);
    	return view('admin.article.index', compact('articles'));
    }

    /**
     * Dispaly the create article form.
     * 
     * @return Illuminate\Foundation\Http\response
     */
    public function create() {
    	$categories = Category::select('id', 'name')->where('id', '!=', 1)->get();
    	return view('admin.article.create', compact('categories'));
    }

    /**
     * Store and create new article.
     * 
     * @param  Request $request 
     * @param  Article $article 
     * @return Illuminate\Foundation\Http\response           
     */
    public function store(Request $request, Article $article) {
    	$this->validate($request, [
    		'subject'	=> 'required|min:2|max:255|unique:articles',
    		'category'	=> 'required|exists:categories,id',
    		'slug'		=> 'min:2|max:255|unique:articles',
    		'tags'	    => 'max:255',
    		'content'	=> 'required'
    	]);

    	$this->user->articles()->create([
    		'subject'		=> $request->subject,
    		'category_id'	=> $request->category,
    		'slug'			=> $request->slug ?: $request->subject,
    		'tags'		    => $request->tags,
    		'content'		=> $request->content
    	]);

    	return redirect()->route('article.index');
    }

    /**
     * Display the edit form.
     * 
     * @param  Article $article 
     * @return Illuminate\Foundation\Http\response
     */
    public function edit(Article $article) {
    	$categories = Category::all('id', 'name');
    	return view('admin.article.edit', compact('article', 'categories'));
    }

    /**
     * Update the spacified article.
     * 
     * @param  Request $request 
     * @param  Article $article 
     * @return Illuminate\Foundation\Http\response
     */
    public function update(Request $request, Article $article) {
    	$this->validate($request, [
    		'subject' 	=> 'required|min:3|max:255|unique:articles,subject,'.$article->id,
    		'category'	=> 'required|exists:categories,id',
    		'slug'		=> 'unique:articles,slug,'.$article->id,
            'tags'      => 'max:255',
    		'content'	=> 'required'
    	]);

    	$article->update([
    		'subject'		=> $request->subject,
    		'category_id'	=> $request->category,
    		'slug'			=> $request->slug ?: $request->subject,
    		'tags'		    => $request->tags,
    		'content'		=> $request->content
    	]);

    	return back();
    }

    /**
     * Delete specified article.
     * 
     * @param  Article $article 
     * @return Illuminate\Foundation\Http\response
     */
    public function destroy(Article $article) {
        $article->delete();
        Redis::del('article.'.$article->id.'.views');

        return back();
    }
}
