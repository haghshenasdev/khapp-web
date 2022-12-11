<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppHomeDataResource;
use App\Models\HomeItem;
use App\Models\Pooyesh;
use Illuminate\Support\Facades\Http;

class AppHomeData extends Controller
{
    public function index($charity)
    {
        return response()->json([
            'data' => [
                'homeItems' => HomeItem::all()
                    ->where('charity',$charity)
                    ->where('is_active',1)
                ,
                'pooyeshes' => \App\Models\Pooyesh::where('charity',$charity)
                    ->where('is_active',1)
                    ->get(['id','title','image'])
                ,
                'projects' => \App\Models\Project::where('charity',$charity)
                    ->where('is_active',1)
                    ->get(['id','title','image_head','pishraft'])
                ,
                'slider' => \App\Models\Slider::where('charity',$charity)
                    ->where('is_active',1)
                ,
                'hadis' => \App\Models\Hadis::where('charity',$charity)->inRandomOrder()->first(),
            ]
        ]);
    }
}
