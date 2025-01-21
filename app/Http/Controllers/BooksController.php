<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\BookAuthor;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBookRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::paginate(10);
        $authors = Author::paginate(10);

        // Fetch books with related genres and authors
        $books = Book::with(['genre', 'authors'])->paginate(10);

        return view('dashboard.books.index', compact('genres', 'authors', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $genres = Genre::all();

        // return view('dashboard.books.books' ,compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        // Validate incoming request
        $validated = $request->all();

        // Handle file upload
        if ($request->hasFile('book_file') && $request->file('book_file')->isValid()) {
            // Store the PDF file in the 'public' disk and get the file path
            $filePath = $request->file('book_file')->store('books/pdfs', 'public');
        } else {
            // Default to null if no file is uploaded
            $filePath = null;
        }



        // Create a new book record with the validated data and file path
        $book = Book::create([
            'title' => $validated['title'],
            'genre_id' => $validated['genre_id'],
            'publication_year' => $validated['publication_year'],
            'book_file' => $filePath,  // Save the file path in the database
        ]);

        // Insert the relationship between the book and author into the pivot table
        if (BookAuthor::insert([
            'author_id' => $validated['author_id'],
            'book_id' => $book->id,
        ])) {
            return redirect()->back()->with('success', 'New Book added successfully');
        }

        // Return error if insert fails
        return redirect()->back()->with('error', 'There was an issue adding the book');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::with(['genre', 'authors'])->findOrFail($id);


        return view('dashboard.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */ public function edit(string $id)
    {
        $book = Book::with(['genre', 'authors'])->findOrFail($id);
        $genres = Genre::all();
        $authors = Author::all();

        return view('dashboard.books.edit', compact('book', 'genres', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->all();

        $book->update($validated);

        $book->authors()->sync($validated['authors']);

        // Handle file upload
        if ($request->hasFile('book_file')) {
            $filePath = $request->file('book_file')->store('books', 'public');
            $book->update(['book_file' => $filePath]);
        }

        return redirect()->route('books.index')->with('success', 'Book details updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the book by its ID
        $book = Book::findOrFail($id);

        // Delete the associated book_author entries (if any)
        BookAuthor::where('book_id', $id)->delete();

        // If the book has an associated file, delete it from the storage
        if ($book->book_file) {
            // Delete the file from the storage
            Storage::disk('public')->delete($book->book_file);
        }

        // Delete the book record
        $book->delete();

        // Redirect back with a success message
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
