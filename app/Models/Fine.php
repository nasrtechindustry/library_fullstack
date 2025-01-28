<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{

    protected $table = 'fines';

    public $timestamps = false;
    protected $fillable = [
        'loan_id',
        'fine_amount'
    ];
}
