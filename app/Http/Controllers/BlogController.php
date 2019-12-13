<?php

namespace App\Http\Controllers;

use App\Blog;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Blog $blog)
    {
        $blog = new Blog;
        $posts = $blog->paginate();
        return view('blog.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request, Blog $blog, File $file)
    {
        $blog->create($this->postValidate());

        if($request->hasfile('file')){
            if($request->file('file')->isValid()){
                $fname = $request->file('file')->store('files');
                $file->blog_id = $blog->id;
                $file->path = $fname;
                $file->save();
            }
        }
        
        return redirect()->route('blog.index');
    }

    public function show(Blog $blog)
    {
        return view('blog.show', ['post' => $blog]);
    }

    public function edit(Blog $blog)
    {
        
        return view('blog.edit', ['post' => $blog]);
    }

    public function update(Request $request, Blog $blog, File $file)
    {
        $blog->update($this->postValidate());

        if($request->hasfile('file')){
            if($request->file('file')->isValid()){
                $files = $blog->files;
                foreach ($files as $key => $file) {
                    $file->delete();
                    Storage::delete($file->path);
                }
                $fname = $request->file('file')->store('files');
                $file->blog_id = $blog->id;
                $file->path = $fname;
                $file->save();
            }
        }
        return redirect()->route('blog.show', $blog->id);
    }

    public function destroy(Blog $blog)
    {
        $files = $blog->files;
        foreach ($files as $key => $file) {
            Storage::delete($file->path);
        }
        $blog->delete();
        return redirect()->route('blog.index');
    }

    protected function postValidate(){
        return request()->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);
    }
}
