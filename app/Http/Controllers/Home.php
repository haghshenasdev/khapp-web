<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function show(){
        return view('welcome');
    }
}
