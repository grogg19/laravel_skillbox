<?php

use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'components.dashboard')->middleware('admin')->name('admin.index');

Route::resource('admin/article', 'Admin\AdminArticlesController')->middleware('admin');


