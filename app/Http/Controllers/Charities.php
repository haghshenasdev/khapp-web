<?php

namespace App\Http\Controllers;

class Charities extends Controller
{
    public function index()
    {
        return view('dashboard.charities');
    }
}
