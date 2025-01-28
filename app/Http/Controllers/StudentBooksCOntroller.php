<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class StudentBooksCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('library.index');
    }

    /**`
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::with(['genre', 'authors'])->findOrFail($id);


        return view('library.show', compact('book'));
    }

    /**
     * Summary of requestBook
     * @param mixed $id
     * @return RedirectResponse
     */
    public function requestBook($id): RedirectResponse
    {
        if (auth()->user()->roles !== 'student') {
            return redirect()->back()->with("error", "Only students can request books from the library.");
        }

        $student = Student::where('user_id', auth()->user()->id)->first();

        if (!$student) {
            return redirect()->back()->with("error", "Student record not found.");
        }

        $loan = Loan::where('book_id', $id)->first();

        if ($loan) {
            return redirect()->back()->with("error", "You have already request this book please visit the library");
        }
        $loaned = Loan::insert([
            'student_id' => $student->id,
            'book_id' => $id,
            'loan_date' => now(),
            'return_date' => Carbon::now()->addDays(7)
        ]);

        if ($loaned) {
            return redirect()->back()->with("success", "You have successfully requested a book. Please visit the librarian to get your requested book.");
        } else {
            return redirect()->back()->with("error", "Failed to request the book. Please try again.");
        }
    }
}
