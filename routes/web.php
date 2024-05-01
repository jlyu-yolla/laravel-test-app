<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

// route set up for books crud
Route::get('books/create', [BookController::class, 'create']);
Route::post('books', [BookController::class, 'store']);
Route::get('books', [BookController::class, 'index']);
Route::get('books/{book}/edit', [BookController::class, 'edit']); //should be get display form
Route::put('books/{book}', [BookController::class, 'update']);
Route::delete('books/{book}', [BookController::class, 'destroy']);
//Route::resource('books',BookController::class);
// is it better to manually define routes or use Route::resource()?
// is ->name() necessary when defining routes? might just be better if you want to refactor with named routes

Route::get('authors/create', [AuthorController::class, 'create']);
Route::post('authors', [AuthorController::class, 'store']);
Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors/{author}/edit', [AuthorController::class, 'edit']); // display form which will get routed to update
Route::put('authors/{author}', [AuthorController::class, 'update']);
Route::delete('authors/{author}', [AuthorController::class, 'destroy']);


Route::get('/', function () {
    return view('welcome');
});
