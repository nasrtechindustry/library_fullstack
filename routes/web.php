<?php

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FineController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentBooksCOntroller;

Route::get('/', function () {

    $genres = Genre::paginate();
    $authors = Author::paginate();

    $books = Book::with(['genre', 'authors'])->paginate();

    return view('welcome', compact('genres', 'authors', 'books'));
});


Route::get('/dashboard', function () {
    $totalStudents = Student::count();

    $totalLoanedBooks = Loan::whereNotNull('return_date')->count();

    $totalRevenue = Fine::sum('fine_amount');

    $revenueData = [];
    $months = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i);
        $revenue = Fine::whereMonth('fine_date', $month->month)
            ->whereYear('fine_date', $month->year)
            ->sum('fine_amount');

        $revenueData[] = $revenue;
        $months[] = $month->format('M Y');
    }

    return view('dashboard', compact('totalStudents', 'totalLoanedBooks', 'totalRevenue', 'revenueData', 'months'));
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

    Route::post('/payment/overdue/{id}', [FineController::class, 'save_fine'])->name('payment.overdue');
});

Route::middleware(['auth'])->group(function () {
    Route::get('library/{id}', [StudentBooksCOntroller::class, 'show'])->name('library.show');
    Route::get('requestBook/{id}', [StudentBooksCOntroller::class, 'requestBook'])->name('library.requestBook');
});
require __DIR__ . '/auth.php';
