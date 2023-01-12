<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\queries\Queries;
use Illuminate\Http\Request;

class Projects extends Controller
{
    public function index()
    {
        return view('dashboard.projects.projects');
    }

    public function show(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $project = Queries::getProjects()->findOrFail($validateData['id']);

        return view('dashboard.projects.showProject',['project' => $project]);
    }
}
