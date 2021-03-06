<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/create', 'BlogController@create')->name('blog.create');
Route::get('/blog/{blog}', 'BlogController@show')->name('blog.show');
Route::post('/blog', 'BlogController@store')->name('blog.store');
Route::get('/blog/{blog}/edit', 'BlogController@edit')->name('blog.edit');
Route::put('/blog/{blog}', 'BlogController@update')->name('blog.update');
Route::delete('/blog/{blog}', 'BlogController@destroy')->name('blog.destroy');

Route::post('/blog/comment/{comment?}', 'CommentController@store')->name('blog.comment.store');
Route::get('/blog/comment/{comment}/re', 'CommentController@comment')->name('blog.comment.comment');
Route::get('/blog/comment/{comment}/edit', 'CommentController@edit')->name('blog.comment.edit');
Route::put('/blog/comment/{comment}', 'CommentController@update')->name('blog.comment.update');
Route::delete('/blog/comment/{comment}', 'CommentController@destroy')->name('blog.comment.destroy');

Route::post('/editor/upload', function(){
    $fname = request()->upload->store('editor');
    $funcNum = request()->CKEditorFuncNum;
    $url = asset($fname);
    $message = 'uploaded';
    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
})->name('editor.upload');

Route::get('/mypage', 'MypageController@index')->name('mypage.index');
Route::get('/mypage/blog', 'MypageController@blog')->name('mypage.blog');
Route::get('/mypage/comment', 'MypageController@comment')->name('mypage.comment');
Route::get('/mypage/user', 'MypageController@user')->name('mypage.user');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


