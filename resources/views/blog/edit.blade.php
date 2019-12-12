@extends('layouts.app')
@section('content')
    <form action="{{ route('blog.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="subject">subject</label>
          <input type="text"
            class="form-control @error('subject') is-invalid @enderror"
            name="subject"
            id="subject"
            aria-describedby="helpId"
            placeholder="제목을 입력하세요"
            value="{{ $errors->has('subject')? old('subject') : $post->subject }}">
            @error('subject')
            <div class="invalid-feedback">제목을 입력하세요</div>
            @enderror
        </div>
        <div class="form-group">
          <label for="file">file</label>
          <input type="file" class="form-control-file" name="file" id="file" placeholder="" aria-describedby="fileHelpId">
        </div>
        <div class="form-group">
          <label for="">content</label>
          <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3">{{ $errors->has('content')? old('content') : $post->content }}</textarea>
          @error('content')
          <div class="invalid-feedback">내용을 입력하세요</div>
          @enderror
        </div>
        <a name="" id="" class="btn btn-secondary" href="{{ url()->previous() }}" role="button">취소</a>
        <button type="submit" class="btn btn-primary">저장</button>
    </form>
@endsection