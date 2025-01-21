<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";

    protected $fillable = [
        'title',
        'genre_id',
        'publication_year',
        'book_file'
    ];


    /**
     * Define the relationship with Genre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    /**
     * Summary of authors
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'book_id', 'author_id');
    }
    
}
