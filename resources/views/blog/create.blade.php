@extends('layouts.app')
@section('content')
    <form action="{{ route('blog.store') }}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="form-group">
          <label for="subject">subject</label>
          <input type="text"
            class="form-control @error('subject') is-invalid @enderror"
            name="subject"
            id="subject"
            aria-describedby="helpId"
            placeholder="제목을 입력하세요"
            value="{{ old('subject') }}">
            @error('subject')
            <div class="invalid-feedback">제목을 입력하세요</div>
            @enderror
        </div>
        <div class="form-group">
          <label for="file">file</label>
          <input type="file" class="form-control-file" name="file[]" id="file" placeholder="" aria-describedby="fileHelpId" multiple>
        </div>
        <div class="form-group">
          <label for="">content</label>
          <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3">{{ old('content') }}</textarea>
          @error('content')
          <div class="invalid-feedback">내용을 입력하세요</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="{{ asset('ckeditor4/ckeditor.js') }}"></script>
    <script>
    CKEDITOR.replace('content', {
      filebrowserUploadUrl : "{{ route('editor.upload') }}",
      filebrowserUploadMethod: 'form'
    });
    </script>
@endsection