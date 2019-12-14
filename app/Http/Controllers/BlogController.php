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
        foreach ($posts as $key => $post) {
            $post->thumb = $post->files->whereIn('extension', ['jpg', 'png', 'gif'])->sortByDesc('id');
        }
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
            $this->storeFiles($request->file('file'), $stored);
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
            $this->destroyFiles($request->delete_file);
        }
        
        if($request->hasfile('file')){
            $this->destroyFiles($request->file('file'));
            $this->storeFiles($request->file('file'), $blog);
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

    protected function storeFiles($files, $post){
        foreach ($files as $key => $value) {
            if($value->isValid()){
                $file = new File;
                $fname = $value->store('files');
                $file->blog_id = $post->id;
                $file->path = $fname;
                $file->oriname = $value->getClientOriginalName();
                $file->extension = $value->getClientOriginalExtension();
                $file->save();
            }
        }
    }

    protected function destroyFiles($files){
        foreach ($files as $key => $value) {
            $file = new File;
            $target = $file->find($key);
            if(isset($target->path)){
                Storage::delete($target->path);
                $target->delete();
            }
        }
    }
}
