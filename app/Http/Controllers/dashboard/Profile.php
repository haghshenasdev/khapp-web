<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class Profile extends Controller
{
    public function index()
    {
        return view('dashboard.profile');
    }
}
