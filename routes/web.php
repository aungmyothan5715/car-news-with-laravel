<?php

use Illuminate\Support\Facades\Route;
use App\User;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
/*
Route::post('/users', function(CreateUserRequest $request){
    $user = User::create($request->validated());
    Mail::to($user->email)->send(new WelcomeMessage);
    return $user;
});


Route::get('users/{user}', function(User $user){
    return $user;
});
*/



// This  route for Post 
Route::get('/posts', 'PostController@index')->name('post.index');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');
Route::get('/post/{id}/detail', 'PostController@show')->name('post.detail');
Route::get('/post/{id}/edit', 'PostController@edit')->name('post.edit');
Route::post('/post/{id}/update', 'PostController@update')->name('post.update');
Route::get('post/{id}/destroy', 'PostController@destroy')->name('post.destroy');


//This route for Comment
Route::get('post/comment', 'CommentController@index')->name('comment.index');
Route::post('post/comment/create', 'CommentController@create')->name('comment.create');
Route::get('post/comment/delete/{id}', 'CommentController@delete')->name('comment.add');



