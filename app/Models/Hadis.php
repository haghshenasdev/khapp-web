<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadis extends Model
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

    protected $hidden = ['is_active','charity','id'];


}
