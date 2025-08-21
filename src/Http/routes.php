<?php

use Illuminate\Support\Facades\Route;

// App routes
Route::middleware(['web'])->controller('\Bishopm\Lightworx\Http\Controllers\HomeController')->group(function () {
    Route::get('/', 'home')->name('home');
});

// Reports
Route::middleware(['web'])->controller('\Bishopm\Lightworx\Http\Controllers\ReportsController')->group(function () {
    Route::get('/admin/reports/invoices/{id}', 'invoice')->name('invoice');
});


