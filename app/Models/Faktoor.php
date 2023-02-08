<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktoor extends Model
{
    use HasFactory;

    protected $table = 'faktoors';

    protected $fillable = [
        'userid',
        'amount',
        'type',
        'sabtid',
        'ResNum',
        'is_pardakht',
        'charity',
    ];
}
