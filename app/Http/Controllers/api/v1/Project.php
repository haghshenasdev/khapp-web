<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Project extends Controller
{
    public function index(Request $request,$charity)
    {
        if ($dataProject = \App\Models\Project::where('id',$id = $request->input('id'))->where('charity',$charity)->where('is_active',1)->first())
        return  [
            'data' => $dataProject
        ];

        return  response()->json(
            ['data' => \App\Models\Project::all()->where('is_active',1)->where('charity',$charity)]
        );
    }
}
