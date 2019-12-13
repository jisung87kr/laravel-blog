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

    public function store(Request $request, Blog $blog)
    {
        $stored = $blog->create($this->postValidate());
        if($request->hasfile('file')){
            foreach ($request->file('file') as $key => $value) {
                if($value->isValid()){
                    $file = new File;
                    $fname = $value->store('files');
                    $file->blog_id = $stored->id;
                    $file->path = $fname;
                    $file->oriname = $value->getClientOriginalName();
                    $file->save();
                }
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

    public function update(Request $request, Blog $blog)
    {
        $blog->update($this->postValidate());

        if($request->delete_file){
            foreach ($request->delete_file as $key => $value) {
                $file = new File;
                $target = $file->find($key);
                if(isset($target->path)){
                    Storage::delete($target->path);
                    $target->delete();
                }
            }
        }
        
        if($request->hasfile('file')){
            foreach ($request->file('file') as $key => $value) {
                $file = new File;
                $oldfile = $file->find($key);
                if(isset($oldfile->path)){
                    Storage::delete($oldfile->path);
                    $oldfile->delete();
                }
            }

            foreach ($request->file('file') as $key => $value) {
                if($value->isValid()){
                    $file = new File;
                    $fname = $value->store('files');
                    $file->blog_id = $blog->id;
                    $file->path = $fname;
                    $file->oriname = $value->getClientOriginalName();
                    $file->save();
                }
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
