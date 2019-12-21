<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request, Comment $comment)
    {
        request()->validate([
            'content' => 'required'
        ]);
        $cmt = new Comment;
        if($comment->id){
            $comment_order_max = $cmt->where('parent_id', $comment->id)->where('depth', $comment->depth+1)->max('comment_order');
            if($comment_order_max == null){
                $comment_order_max = $comment->comment_order;
            };

            $comment_order = $comment_order_max+1;
            DB::update('update comments set comment_order = comment_order+1 where blog_id = ? and comment_order > ?', [$request->blog_id, $comment_order_max]);
            $depth = ($comment->depth)+1;
            $cmt->parent_id = $comment->id;
        } else {
            $comment_order = $cmt->max('comment_order')+1;
            $depth = 0;
            $cmt->parent_id = 0;
        }
        
        $cmt->content = $request->content;
        $cmt->blog_id = $request->blog_id;
        $cmt->comment_order = $comment_order;
        $cmt->depth = $depth;
        $cmt->save();
        $cmt->where('depth', 0)->where('id', $cmt->id)->update(['parent_id' => $cmt->id]);
        
        return redirect()->route('blog.show', $request->blog_id);
    }

    public function comment(Comment $comment)
    {
        return view('blog.comment', ['post' => $comment->blog,'comment' => $comment]);
    }

    public function edit(Comment $comment)
    {
        return view('blog.comment_edit', ['comment' => $comment]);
    }

    public function update(Request $request, Comment $comment)
    {
        request()->validate([
            'content' => 'required'
        ]);
        $comment->content = $request->content;
        $comment->save();
        return redirect()->route('blog.show', $comment->blog->id);
    }

    public function destroy(Comment $comment)
    {
        $blog_id = $comment->blog->id;
        $comment->delete();
        return redirect()->route('blog.show', $blog_id);
    }
}
