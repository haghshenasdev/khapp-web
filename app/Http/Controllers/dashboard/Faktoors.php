<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class Faktoors extends Controller
{
    public function index()
    {
        return view('dashboard.faktoors.faktoors');
    }
}
