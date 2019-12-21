<form action="{{ route('blog.comment.store') }}" method="POST">
    @csrf
    <input type="hidden" name="blog_id" value="{{ $id }}">
    <div class="form-group">
        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="" rows="3"></textarea>
        @error('content')
        <div class="invalid-feedback">내용을 입력하세요</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">댓글쓰기</button>
</form>