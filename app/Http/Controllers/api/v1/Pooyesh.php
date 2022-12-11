<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pooyesh extends Controller
{
    public function index(Request $request,$charity)
    {
        if ($dataPooyesh = \App\Models\Pooyesh::where('id',$id = $request->input('id'))->where('is_active',1)->where('charity',$charity)->first())
            return  [
                'data' => $dataPooyesh
            ];

        return  response()->json(
        ['data' => \App\Models\Pooyesh::all()->where('is_active',1)->where('charity',$charity)]
    );
    }
}
