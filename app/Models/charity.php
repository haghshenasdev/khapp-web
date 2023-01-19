<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class charity extends Model
{
    use HasFactory;

    protected $table = 'charities';

    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'shortname',
    ];

}
