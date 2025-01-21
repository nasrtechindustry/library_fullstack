<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthorController extends Controller
{
    /**
     * Summary of store
     * @param \App\Http\Requests\AuthorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthorRequest $request): RedirectResponse{

        $validated = $request->all();

        $validated['created_at'] = now();

        $author  = Author::saveAuthor($validated );


        if ($author) {

            return redirect()->back()->with('success' ,'New Author added successully');
        }

        return redirect()->back()->with('fail' ,'Fail to create new user');

    }
}
