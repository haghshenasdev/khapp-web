<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $hidden = ['is_active','charity'];

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'image_head',
        'pishraft',
        'type_pay',
        'type_pay',
    ];


}
