@extends('layouts.app')
@section('content')
    @foreach($posts as $post)
    <div class="card mb-3">
        <div class="row no-gutters">
            @if($post->thumb->first())
            <div class="col-md-4">
                <img src="{{ asset($post->thumb->first()->path) }}" class="card-img" alt="...">
            </div>
            @endif
            <div class="{{ empty($post->thumb->first()) == false ? 'col-md-8' : 'col-md-12' }}">
            <div class="card-body">
                <a href="{{ route('blog.show', $post->id) }}">
                    <h5 class="card-title">{{ $post->subject}}</h5>
                </a>
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-text"><small class="text-muted">{{ $post->created_at }}</small></p>
            </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class='mt-3'>
        <a name="" id="" class="btn btn-primary" href="{{ route('blog.create') }}" role="button">글쓰기</a>
    </div>
@endsection