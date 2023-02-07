<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'is_active',
        'charity',
        'sub',
        'default',
        'optional_sub_select',
    ];
}
