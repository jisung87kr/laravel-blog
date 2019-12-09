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

Route::get('/blog/{id}', 'BlogController@show')->name('blog.show');

Route::post('/blog', 'BlogController@store')->name('blog.store');

Route::get('/blog/{id}/edit', 'BlogController@edit')->name('blog.edit');

Route::put('/blog/{id}', function(){
    return 'update post';
})->name('blog.update');

Route::delete('/blog/{id}', function(){
    return 'delte post';
})->name('blog.delte');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
