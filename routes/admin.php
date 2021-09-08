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
    Route::get('admin/reports/total-report', [AdminReportsController::class, 'totalReport'])->name('admin.reports.total');
    Route::post('admin/reports/total-report', [AdminReportsController::class, 'makeReport'])->name('admin.reports.make');
});


