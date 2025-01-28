<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function save_fine(Request $request, $id)
    {
        $loan = Loan::where('id', $id)->first();
    
        if ($loan) {
            $fineAmount = str_replace(',', '', $request->input('fine_amount'));
    
            $fine = Fine::create([
                'loan_id' => $loan->id,
                'fine_amount' => $fineAmount,
                'fine_date' => now()
            ]);
    
            if ($fine) {
                $loan->delete();
                return redirect()->route('loans.index')->with('success', 'Student payment has been confirmed');
            } else {
                return redirect()->back()->with('error', 'Failed to record fine');
            }
        }
    
        return redirect()->back()->with('error', 'Loan not found');
    }
    
}
