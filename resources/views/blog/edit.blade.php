@extends('layouts.app')
@section('content')
    <form action="{{ route('blog.update', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="subject">subject</label>
          <input type="text"
            class="form-control"
            name="subject"
            id="subject"
            aria-describedby="helpId"
            placeholder="제목을 입력하세요"
            value='{{ $post->subject }}'>
        </div>
        <div class="form-group">
          <label for="">content</label>
          <textarea class="form-control" name="content" id="content" rows="3">{{ $post->content }}</textarea>
        </div>
        <a name="" id="" class="btn btn-secondary" href="{{ url()->previous() }}" role="button">취소</a>
        <button type="submit" class="btn btn-primary">저장</button>
    </form>
@endsection