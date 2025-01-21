<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    protected $fillable = [
        'genre'
    ];


    public static function storeGenre(string $genre){
        return self::insert(['genre_name' => $genre]);
    }
}
