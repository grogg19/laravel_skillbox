<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ArticlesController@index')->name('mainPage');
Route::get('/articles/create', 'ArticlesController@create')->name('createArticle');
Route::post('/articles/store', 'ArticlesController@store')->name('saveArticle');
Route::get('/articles/{slug}', 'ArticlesController@show')->name('showArticle');

Route::get('/feedback', 'MessagesController@index')->name('feedbackPage');
Route::get('/contacts', 'MessagesController@create')->name('contactsPage');
Route::post('/contacts/store', 'MessagesController@store')->name('saveMessage');

Route::get('/about/', function () {
    return view('about');
})->name('aboutPage');
