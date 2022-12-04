<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hadis extends Model
{
    use HasFactory;

    protected $table = 'hadises';

    protected $fillable = [
        'gala',
        'arabi',
        'farsi',
        'manba',
        'group',
        'is_active',
    ];

}
