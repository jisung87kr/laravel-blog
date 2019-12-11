@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>no</th>
                <th>subject</th>
                <th>created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td scope="row">{{ $post->id }}</td>
                <td>
                    <a href="{{ route('blog.show', $post->id)}}">{{ $post->subject }}</a>
                </td>
                <td>{{ $post->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class='mt-3'>
        <a name="" id="" class="btn btn-primary" href="{{ route('blog.create') }}" role="button">글쓰기</a>
    </div>
@endsection