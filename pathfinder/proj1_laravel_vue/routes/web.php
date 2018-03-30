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

Auth::routes();

// posts
Route::get('/getposts', 'PostController@getPosts');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/myposts', 'PostController@myposts')->name('myposts');
Route::get('/posts/create', 'PostController@create');
Route::post('/posts', 'PostController@store');
Route::get('/posts/{post}', 'PostController@show');
Route::delete('/posts/{post}', 'PostController@delete'); // delete post

// comments
Route::post('/comments', 'CommentController@create');
Route::delete('/comments/{comment}', 'CommentController@delete'); // delete comment

// settings
Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings/username', 'SettingsController@username');
Route::post('/settings/email', 'SettingsController@email');

// user roles
Route::get('/roles', 'UserRolesController@index')->name('roles');
Route::post('/roles/{id}', 'UserRolesController@store');
