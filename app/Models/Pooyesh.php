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

    protected $fillable = [
        'title',
        'description',
        'image',
        'amount',
        'start',
        'end',
        'type_pay',
        'is_active',
        'charity',
    ];

}
