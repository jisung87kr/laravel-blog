@extends('layouts.app')
@section('content')
    @include('blog.includes.comment_create', ['blog_id' => $post->id, 'parent' => $comment])
@endsection