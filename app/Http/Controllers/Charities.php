<?php

namespace App\Http\Controllers;

use App\Models\CharitiesMeta;
use App\Models\charity;
use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'shortname' => ['required','string'],
            'fullname' => ['required','string'],
            'phone' => ['required'],
            'website' => ['url'],
            'about' => ['string'],
        ]);

        $charityId = charity::query()->insertGetId([
            'shortname' => $validatedData['shortname'],
            'fullname' => $validatedData['fullname'],
            'is_active' => 1,
        ]);

        CharitiesMeta::query()->insert([
            'charity' => $charityId,
            'phone' => $validatedData['phone'],
            'website' => $validatedData['website'],
            'about' => $validatedData['about'],
        ]);

        return redirect(route('charities'));
    }
}
