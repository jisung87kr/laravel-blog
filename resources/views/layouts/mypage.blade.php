@extends('layouts.app')
@section('content')
    <div class="row">
        @include('mypage.includes.nav')
        <div class="col-9">
            @yield('mypage.content')
        </div>
    </div>
@endsection