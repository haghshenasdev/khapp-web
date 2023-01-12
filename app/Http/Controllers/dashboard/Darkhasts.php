<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\queries\Queries;
use Illuminate\Http\Request;

class Darkhasts extends Controller
{
    public function index()
    {
        return view('dashboard.darkhasts.darkhasts');
    }

    public function show(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $darkhast = Queries::getDrakhasts()->findOrFail($validateData['id']);

        return view('dashboard.darkhasts.showDarkhast',[
            'darkhast' => $darkhast,
            'types' => Queries::getDarkhastsTypes()->get(),
            'darkhast_statuses' => Queries::getDarkhastStatuses()->get(),
        ]);
    }
}
