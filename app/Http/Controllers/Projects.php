<?php

namespace App\Http\Controllers;

class Projects extends Controller
{
    public function index()
    {
        return view('dashboard.projects');
    }
}
