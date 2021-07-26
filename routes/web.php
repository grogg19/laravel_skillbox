<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ArticlesController@index')->name('page.main');
Route::get('/articles/create', 'ArticlesController@create')->name('article.create');
Route::post('/articles/store', 'ArticlesController@store')->name('article.save');
Route::get('/articles/{slug}', 'ArticlesController@show')->name('article.show');

Route::get('/feedback', 'MessagesController@index')->name('page.feedback');
Route::get('/contacts', 'MessagesController@create')->name('page.contacts]');
Route::post('/contacts/store', 'MessagesController@store')->name('message.save');

Route::get('/about/', function () {
    return view('about');
})->name('page.about');
