<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'sub',
        'is_active',
    ];

    public static function getSubs(){
        return DB::table('menus')
        ->join('menus','menus.id','=','menus.sub')
        ->get();
    }
}
