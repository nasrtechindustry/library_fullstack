<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    protected $table = "book_author";

    protected $fillable = [
        'author_id',
        'book_id',
    ];

    /**
     * Summary of authors
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function author()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id');
    }

    /**
     * Summary of books
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function book()
    {
        return $this->belongsToMany(Book::class, 'book_author', 'author_id', 'book_id');
    }
}
