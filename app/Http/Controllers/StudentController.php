<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class StudentController extends Controller
{
    /**
     * Summary of store
     * @return void
     */
    public function store(StudentRequest $request): RedirectResponse{
        $validated = $request->all();
        $validated['password'] = $validated['last_name'];
        $reg_no = $validated['reg_no'];

        if ($validated['roles'] == 'student'){

            $user = User::create($validated);

            event(new Registered($user));

            if ($user){
                $user_id = $user->id;

                Student::create([
                    'user_id' => $user_id,
                    'reg_no' => $reg_no,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }


            return redirect()->back()->with('success' , 'Student registered successully ');
        }

    }
    /**
     * Summary of approve
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $student = Student::findOrFail($id);
        $student->status = 'approved';
        $student->save();

        return redirect()->back()->with('success', 'Student status updated to Approved.');
    }

    /**
     * Summary of restrict
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restrict($id)
    {
        $student = Student::findOrFail($id);
        $student->status = 'pending';
        $student->save();

        return redirect()->back()->with('success', 'Student status updated to Pending.');
    }

    /** */

    public function destroy($id){
        $student = Student::findOrFail($id);
        if ($student) {
            $delete = $student->user_id;
            $user =  User::findOrFail($delete);
            if ($user){
                $user->delete();
                return redirect()->back()->with('success' , 'Student  '.$student->reg_no.' successfully deleted');
            }
        }
        return redirect()->back()->with('error' , "Fail to find that student");
    }
}
