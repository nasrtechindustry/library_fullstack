<?php

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {

    $genres = Genre::paginate();
    $authors = Author::paginate();

    $books = Book::with(['genre', 'authors'])->paginate();

    return view('welcome', compact('genres', 'authors', 'books'));
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'student.status'])->name('dashboard');

Route::middleware(['auth', 'student.status'])->group(function () {
    Route::resource('books', BooksController::class);
    Route::resource('loans', LoansController::class);
    Route::resource('members', MembersController::class);
    Route::resource('reports', ReportsController::class);
    Route::resource('returns', ReturnsController::class);

    Route::get('/genre', [GenreController::class, 'create'])->name('genre.create');
    Route::get('/genre', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/author', [AuthorController::class, 'store'])->name('author.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/approve', [StudentController::class, 'approve'])->name('students.approve');
    Route::get('/students/{id}/restrict', [StudentController::class, 'restrict'])->name('students.restrict');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
});

require __DIR__ . '/auth.php';
