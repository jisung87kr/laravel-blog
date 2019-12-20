<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->content = $request->content;
        $comment->blog_id = $request->blog_id;
        $comment->order = 0;
        $comment->depth = 0;
        $comment->save();
        return redirect()->route('blog.show', $request->blog_id);
    }

    public function show(Comment $comment)
    {
        //
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        $blog_id = $comment->blog->id;
        $comment->delete();
        return redirect()->route('blog.show', $blog_id);
    }
}
