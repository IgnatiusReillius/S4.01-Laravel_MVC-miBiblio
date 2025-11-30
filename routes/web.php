<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD
    Route::resource('/bookUser', BookUserController::class);
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
});

Route::middleware('auth')->get('/books/search', [BookController::class, 'search'])
     ->name('books.search');

require __DIR__.'/auth.php';
=======
});

require __DIR__.'/auth.php';
>>>>>>> aecd9aacf9f7f126cab430d21e4fb09891dfa80e
