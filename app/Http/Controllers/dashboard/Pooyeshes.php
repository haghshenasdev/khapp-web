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

        $pooyesh = Queries::getPooyeshes()->findOrFail($request->integer('id'));
        return view('dashboard.pooyeshes.sePooyeshes',['data' => $pooyesh]);
    }

    public function update(Request $request)
    {

    }

    public function new()
    {
        return view('dashboard.pooyeshes.sePooyeshes');
    }
}
