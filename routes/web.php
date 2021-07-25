<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ArticlesController@index');
Route::get('/articles/create', 'ArticlesController@create');
Route::post('/articles/store', 'ArticlesController@store');
Route::get('/articles/{slug}', 'ArticlesController@show');

Route::get('/feedback', 'MessagesController@index');
Route::get('/contacts', 'MessagesController@create');
Route::post('/contacts/store', 'MessagesController@store');

Route::get('/about/', function () {
    return view('about', ['title' => 'О нас']);
});
