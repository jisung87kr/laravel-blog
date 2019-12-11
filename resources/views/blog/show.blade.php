@extends('layouts.app')
@section('content')
    <div class="card">
        <!-- <img class="card-img-top" src="holder.js/100x180/" alt=""> -->
        <div class="card-body">
            <h4 class="card-title">{{ $post->subject }}</h4>
            <p class="card-text">{{ $post->content }}</p>
        </div>
    </div>
    <div class='mt-3'>
        <a name="" id="" class="btn btn-secondary" href="{{ route('blog.index') }}" role="button">목록보기</a>
        <a name="" id="" class="btn btn-primary" href="{{ route('blog.edit', $post->id) }}" role="button">수정하기</a>
    </div>
@endsection