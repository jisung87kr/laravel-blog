@foreach($comments as $comment)
<div class="card mb-3">
    <div class="card-header">
        {{ $comment->created_at }}
    </div>
    <div class="card-body">
        <p class="card-text">{{ $comment->content }}</p>
    </div>
    <div class="card-footer text-muted">
        <a href="{{ route('blog.comment.edit', $comment->id) }}">수정</a>
        <a href="#" onClick="event.preventDefault();
                            document.querySelector('#delete-comment').submit()">삭제</a>
        <a href="{{ route('blog.comment.store') }}">댓글달기</a>
    </div>
    <form action="{{ route('blog.comment.destroy', $comment->id) }}" method="POST" id="delete-comment">
        @csrf
        @method('DELETE')
    </form>
</div>
@endforeach

<form action="{{ route('blog.comment.store') }}" method="POST">
    @csrf
    <input type="hidden" name="blog_id" value="{{ $id }}">
    <div class="form-group">
        <textarea class="form-control" name="content" id="" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">댓글쓰기</button>
</form>