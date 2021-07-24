<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ArticlesController@index');
Route::get('/articles/create', 'ArticlesController@create');
Route::post('/articles/store', 'ArticlesController@store');
Route::get('/articles/{slug}', 'ArticlesController@show');

Route::get('/contacts/', function () {
    return view('contacts', ['title' => 'Контакты']);
});

Route::get('/about/', function () {
    return view('about', ['title' => 'О нас']);
});
