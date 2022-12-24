<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Type
{
    public function index(Request $request,$charity)
    {
        if ($sub = $request->input('sub'))
        {
            return [
                'data' => \App\Models\Type::all()
                    ->where('is_active',1)
                    ->where('charity',$charity)
                    ->where('sub',$sub)
            ];
        }

        if ($request->has('id') && $dataType = \App\Models\Type::where('id',$request->input('id'))
            ->where('is_active',1)
            ->where('charity',$charity)->first()
        ){
            return  [
                'data' => $dataType
            ];
        }


        return  response()->json(
            ['data' => \App\Models\Type::all()
                ->where('is_active',1)
                ->where('charity',$charity)
                ->where('sub',null)
            ]
        );
    }
}
