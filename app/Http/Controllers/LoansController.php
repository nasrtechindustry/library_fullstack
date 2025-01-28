<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
