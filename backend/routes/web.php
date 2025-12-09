<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Публичный доступ к файлам в storage/reports
Route::get('/storage/reports/{filename}', function ($filename) {
    $path = storage_path('app/public/reports/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->name('public.reports');