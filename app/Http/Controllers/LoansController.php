<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isInstanceOf;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $loans = Loan::with(['student', 'book'])->paginate(10);


        return view('dashboard.loans.index', compact('loans'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = Loan::where('id', $id)->with(['book', 'student'])->first();
        if ($loan) {
            return view('dashboard.loans.show', compact('loan'));
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = Loan::where('id', $id)->first();
        if ($loan) {
            $loan->delete();
            return redirect()->back()->with('success', 'The book successfully returned');
        }
    }
}
