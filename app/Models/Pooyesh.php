<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pooyesh extends Model
{
    use HasFactory;

    protected $table = 'pooyeshes';

    protected $hidden = ['is_active','charity'];

    public $timestamps = false;

}
