<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;


class Marasem extends Controller
{
    public function getMarasem(Request $request, $charity)
    {
        $queryBase = \App\Models\Marasem::query()
            ->where('is_active', 1)
            ->where('charity', $charity);

        if ($request->has('id')){
            $queryBase->where('id',$request->integer('id'))->first();
        }

        return response()->json([
            'data' => $queryBase->get()
        ]);
    }

    public function createMarasem(Request $request, $charity)
    {
        return response([
            'error' => 'این قابلیت در آینده در دسترس خواهد بود.'
        ],403);

        $validateData = $request->validate([
            'location' => ['required','string'],
            'marhoom_name' => ['required','string'],
            'marasem_type' => ['nullable',Rule::in([0,1,2])],
            'date' => ['date_format:Y/d/m G:i','required'],
        ]);

        try {
            $insertedID = \App\Models\Marasem::query()->insertGetId([
                'charity' => $charity,
                'is_active' => 0,
                'location' => $validateData['location'],
                'marhoom_name' => $validateData['marhoom_name'],
                'marasem_type' => $validateData['marasem_type'],
                'date' => $validateData['date'],
                'created_by' => Auth::id(),
            ]);

            return response()->json([
                'data' => [
                    'marasemId' => $insertedID
                ]
            ]);
        }catch (\Exception $exception){
            return response([
                'error' => $exception->getMessage()
            ],404);
        }
    }

}
