<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ArticlesController@index');

Route::get('/contacts/', function () {
    return view('contacts', ['title' => 'Контакты']);
});

Route::get('/about/', function () {
    return view('about', ['title' => 'О нас']);
});
