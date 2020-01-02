<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index(){
        return view('mypage.index');
    }

    public function blog(){
        return view('mypage.blog');
    }

    public function comment(){
        return view('mypage.comment');
    }

    public function user(){
        return view('mypage.user');
    }
}
