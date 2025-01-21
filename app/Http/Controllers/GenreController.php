<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request)
    {
        $validated = $request->all();

        $genre = Genre::storeGenre($validated['genre']);

        if ($genre) {
            return redirect()->back()->with('success' , 'Genre added successfully');
        }
        return redirect()->back()->with('fail' , 'Fail to add new genre');




    }

}
