<?php

namespace App\Http\Controllers;

class users extends Controller
{
    public function index()
    {
        return view('dashboard.users');
    }
}
