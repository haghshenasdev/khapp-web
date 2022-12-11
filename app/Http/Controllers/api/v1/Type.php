<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

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

        if ($dataType = \App\Models\Type::where('id',$id = $request->input('id'))
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
