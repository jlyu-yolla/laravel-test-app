<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;

// route set up for books
Route::get('books/create', [BookController::class, 'create']);
Route::post('books', [BookController::class, 'store']);
Route::get('books', [BookController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
