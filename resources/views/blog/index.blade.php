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
@endsection