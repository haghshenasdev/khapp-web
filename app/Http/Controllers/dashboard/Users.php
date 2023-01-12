<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Queries;
use App\Http\Controllers\Request;

class users extends Controller
{
    public function index()
    {
        return view('dashboard.users.users');
    }

    public function show(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $users = Queries::getUsers()->findOrFail($validateData['id']);

        return view('dashboard.users.showUser',['pooyesh' => $users]);
    }
}
