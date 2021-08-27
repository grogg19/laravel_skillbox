<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ArticleCommentsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticlesController::class, 'index'])->name('article.main');

Route::get('/articles/tags/{tag}', [TagsController::class, 'index'])->name('tags.selectByTag');

Route::resource('article', 'ArticlesController');

Route::get('/news', [NewsController::class, 'index'])->name('news.main');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

Route::get('/feedback', 'MessagesController@index')->name('page.feedback');
Route::get('/contacts', 'MessagesController@create')->name('page.contacts');
Route::post('/contacts/store', 'MessagesController@store')->name('message.save');

Route::post('/article/{article}/comment', [ArticleCommentsController::class, 'store'])->name('article.comment.store');

Route::get('/about/', function () {
    return view('about');
})->name('page.about');

require __DIR__ . '/admin.php';

require __DIR__ . '/auth.php';
