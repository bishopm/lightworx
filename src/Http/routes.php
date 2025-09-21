<?php

use Illuminate\Support\Facades\Route;

// PWA Manifest and SW

Route::get('/manifest.json', fn() => response()->view('lightworx::pwa.manifest')->header('Content-Type', 'application/json'));
Route::get('/service-worker.js', fn () => response()->view('lightworx::pwa.service-worker')->header('Content-Type', 'application/javascript'));

// App routes
Route::middleware(['web'])->controller('\Bishopm\Lightworx\Http\Controllers\HomeController')->group(function () {
    Route::get('/', 'home')->name('home');
});

// Reports
Route::middleware(['web'])->controller('\Bishopm\Lightworx\Http\Controllers\ReportsController')->group(function () {
    Route::get('/admin/reports/invoices/{id}', 'invoice')->name('invoice');
});


