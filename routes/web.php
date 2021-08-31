<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticlesController::class, 'index'])->name('article.main');


Route::get('/tags/{tag}', [TagsController::class, 'index'])->name('tags.selectByTag');

Route::resource('article', 'ArticlesController');

Route::get('/news', [NewsController::class, 'index'])->name('news.main');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

Route::get('/feedback', 'MessagesController@index')->name('page.feedback');
Route::get('/contacts', 'MessagesController@create')->name('page.contacts');
Route::post('/contacts/store', 'MessagesController@store')->name('message.save');

Route::post('/add/comment/{type}/{slug}/', [CommentsController::class, 'store'])->name('comment.store');

Route::get('/about/', function () {
    return view('about');
})->name('page.about');

Route::get('/statistics', [StatisticsController::class, 'index'])->name('page.statistics');

require __DIR__ . '/admin.php';

require __DIR__ . '/auth.php';
