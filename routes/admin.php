<?php

use App\Http\Controllers\Admin\AdminReportsController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin')->group( function () {

    Route::view('/dashboard', 'components.dashboard')->name('admin.index');
    Route::resource('admin/article', 'Admin\AdminArticlesController', [
        'as' => 'admin'
    ]);

    Route::resource('admin/news', 'Admin\AdminNewsController', [
        'as' => 'admin'
    ]);

    Route::get('admin/reports', [AdminReportsController::class, 'index'])->name('admin.reports.index');
});


