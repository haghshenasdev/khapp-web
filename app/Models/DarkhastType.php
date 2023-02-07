<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DarkhastType extends Model
{
    use HasFactory;

    protected $table = 'darkhast_types';

    protected $hidden = [
        'is_active',
        'charity',
        'sub',
    ];

    protected $fillable = [
        'title',
        'description',
        'is_active',
        'charity',
        'sub',
        'default',
        'optional_sub_select',
    ];

    public $timestamps = false;
}
