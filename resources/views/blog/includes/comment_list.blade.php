@foreach($comments as $comment)
<div style="padding-left: {{ $comment->depth * 20 }}px">
    <div class="card mb-3">
        <div class="card-body">
            <small class="text-muted">{{ $comment->created_at }}</small>
            <p class="card-text">{{ $comment->content }}</p>
        </div>
        <div class="card-footer text-muted">
            <a href="{{ route('blog.comment.edit', $comment->id) }}">수정</a>
            <a href="#" onClick="event.preventDefault();
                                document.querySelector('#delete-comment{{$loop->index}}').submit()">삭제</a>
            <a href="{{ route('blog.comment.comment', $comment->id) }}">댓글달기</a>
        </div>
        <form action="{{ route('blog.comment.destroy', $comment->id) }}" method="POST" id="delete-comment{{$loop->index}}">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endforeach