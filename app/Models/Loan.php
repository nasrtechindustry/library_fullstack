<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'student_id',
        'book_id'
    ];

    /**
     * Summary of student
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Student, Loan>
     */
    public function student(){
        return $this->belongsTo(Student::class);
    }

    /**
     * Summary of book
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Book, Loan>
     */
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
