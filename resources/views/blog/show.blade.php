@extends('layouts.app')
@section('content')
    <div class="card">
        <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
        <div class="card-body">
            <h4 class="card-title">{{ $post->subject }}</h4>
            <div class="text-muted">{{ $post->created_at }} | {{ $post->user->name }}</div>
            @if(count($post->files))
                <div class="mb-3">
                @foreach($post->files as $file)
                    <a href="{{ asset($file->path) }}" class="d-block text-muted">{{ $file->oriname }}</a>
                @endforeach
                </div>
            @endif
            <p class="card-text">{!! $post->content !!}</p>
        </div>
    </div>
    <div class='mt-3 mb-3'>
        <a name="" id="" class="btn btn-secondary" href="{{ route('blog.index') }}" role="button">목록보기</a>
        @if(Auth::id() == $post->user->id)
        <a name="" id="" class="btn btn-primary" href="{{ route('blog.edit', $post->id) }}" role="button">수정하기</a>
        <a name="" id="" class="btn btn-danger" href="#" role="button" onClick="event.preventDefault();
                                                                                document.getElementById('delete-form').submit()">삭제하기</a>
        @endif
        <form action="{{ route('blog.destroy', $post->id) }}" method='POST' id="delete-form">
            @csrf
            @method('DELETE')
        </form>
    </div>
@include('blog.includes.comment_list', ['post' => $post, 'comments' => $comments])
@include('blog.includes.comment_create', ['blog_id' => $post->id, 'parent' => $post])
@endsection
