<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class Faktoors extends Controller
{
    public function index()
    {
        return view('dashboard.faktoors.faktoors');
    }

    public function print()
    {
        return view('dashboard.faktoors.print');
    }
}
