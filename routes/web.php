<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticlesController::class, 'index'])->name('article.main');

Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('tags.selectByTag');

Route::resource('article', 'ArticlesController');

Route::get('/feedback', 'MessagesController@index')->name('page.feedback');
Route::get('/contacts', 'MessagesController@create')->name('page.contacts');
Route::post('/contacts/store', 'MessagesController@store')->name('message.save');

Route::get('/about/', function () {
    return view('about');
})->name('page.about');
