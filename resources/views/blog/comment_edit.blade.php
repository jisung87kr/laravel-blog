@extends('layouts.app')
@section('content')
<form action="{{ route('blog.comment.update', $comment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="blog_id" value="{{ $comment->id }}">
    <div class="form-group">
        <textarea class="form-control  @error('content') is-invalid @enderror" name="content" id="" rows="3">{{ $comment->content }}</textarea>
        @error('content')
            <div class="invalid-feedback">내용을 입력하세요</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">댓글쓰기</button>
</form>
@endsection