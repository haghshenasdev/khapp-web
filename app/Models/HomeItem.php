<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeItem extends Model
{
    use HasFactory;

    protected $hidden = ['is_active','charity','id'];

    public $timestamps = false;

    protected $fillable = [
        'title',
        'icon',
        'action',
    ];

}
