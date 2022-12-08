<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\hadisresource;
use Illuminate\Http\Request;

class Hadis extends Controller
{
    public function get(Request $request,$charity)
    {
        if ($request->has('all')){
            return  response()->json(
                ['data' => \App\Models\Hadis::all()->where('charity',$charity)]
            );
        }
        if ($id = $request->input('id')){
            return \App\Models\Hadis::where('id',$id)->where('charity',$charity)->first();
        }

        return  \App\Models\Hadis::where('charity',$charity)->inRandomOrder()->first();
    }
}
