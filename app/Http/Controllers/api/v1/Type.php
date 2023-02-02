<?php

namespace App\Http\Controllers\api\v1;

use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Type
{
    public function index(Request $request,$charity)
    {
        if ($request->has('id')){
            return  response()->json([
                'data' => Queries::getTypesFind($request->integer('id'),true,$charity),
            ]);
        }

        return response()->json([
            'data' => Queries::getTypes($request->input('sub'),true,$charity)->get(),
        ]);
    }
}
