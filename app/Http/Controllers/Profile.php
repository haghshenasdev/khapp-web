<?php

namespace App\Http\Controllers;

class Profile extends Controller
{
    public function index()
    {
        return view('dashboard.profile');
    }
}
