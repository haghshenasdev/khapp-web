<?php

namespace App\Http\Controllers;

class Charities extends Controller
{
    public function index()
    {
        return view('dashboard.charities.charities');
    }

    public function new()
    {
        return view('dashboard.charities.newCharity');
    }
}
