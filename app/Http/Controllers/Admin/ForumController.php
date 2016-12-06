<?php

namespace App\Http\Controllers\Admin;

use App\Forum;
use App\ForumCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the forums.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::orderBy('id')->paginate(10);
        return view('admin.forum.index', compact('forums'));
    }

    /**
     * Show the form for creating a new forum.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ForumCategory::all();
        return view('admin.forum.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Forum $forum)
    {
        $this->validate($request, [
            'name'          => 'required|min:3|max:30|unique:forums',
            'description'   => 'max:60',
            'category'      => 'required|exists:forum_categories,id'
        ]);

        $forum->create([
            'name'          => $request->name,
            'description'   => $request->description,
            'category'      => $request->category
        ]);

        return redirect()->route('forum.index');
    }


    /**
     * Show the form for editing the specified forum.
     * @param  Forum  $forum 
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        $categories = ForumCategory::all();
        return view('admin.forum.edit', compact('forum', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        $this->validate($request, [
            'name'          => 'required|unique:forums|max:30|min:3',
            'description'   => 'max:60',
            'category'      => 'required|exists:forum_categories,id'
        ]);

        $forum->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();

        return back();
    }
}
