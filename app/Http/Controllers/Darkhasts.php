<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Darkhasts extends Controller
{
    public function index()
    {
        return view('dashboard.darkhasts');
    }
}
