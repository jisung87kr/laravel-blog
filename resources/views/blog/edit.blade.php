@extends('layouts.app')
@section('content')
    <form action="{{ route('blog.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="subject">subject</label>
          <input type="text"
            class="form-control" name="subject" id="subject" aria-describedby="helpId" placeholder="제목을 입력하세요">
        </div>
        <div class="form-group">
          <label for="">content</label>
          <textarea class="form-control" name="content" id="content" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection