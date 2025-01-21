<?php

use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('books', BooksController::class);
    Route::resource('loans', LoansController::class);
    Route::resource('members', MembersController::class);
    Route::resource('reports', ReportsController::class);
    Route::resource('returns', ReturnsController::class);
    
    Route::get('/genre' , [GenreController::class, 'create'])->name('genre.create');
    Route::get('/genre' , [GenreController::class, 'store'])->name('genre.store');
    Route::get('/author' , [AuthorController::class, 'store'])->name('author.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    
require __DIR__.'/auth.php';
