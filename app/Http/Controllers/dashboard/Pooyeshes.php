<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\queries\Queries;
use Illuminate\Http\Request;

class Pooyeshes extends Controller
{
    public function index()
    {
        return view('dashboard.pooyeshes.pooyeshes');
    }

    public function show(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $pooyesh = Queries::getPooyeshes()->findOrFail($validateData['id']);

        return view('dashboard.pooyeshes.showPooyesh',['pooyesh' => $pooyesh]);
    }
}
