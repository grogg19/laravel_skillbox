<?php

use Illuminate\Support\Facades\Route;


Route::middleware('admin')->group( function () {

    Route::view('/dashboard', 'components.dashboard')->name('admin.index');
    Route::resource('admin/article', 'Admin\AdminArticlesController', [
        'as' => 'admin'
    ]);

});


