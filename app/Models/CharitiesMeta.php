<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharitiesMeta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = [
        'charity',
        'terminal_id',
    ];

    protected $fillable = [
        'terminal_id',
    ];
}
