<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->all();
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

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        }

        return redirect('login');
        
    }
}
