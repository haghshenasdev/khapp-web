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
                'pooyeshes' => \App\Models\Pooyesh::query()->where('charity',$charity)
                    ->where('is_active',1)
                    ->get(['id','title','image'])
                ,
                'projects' => \App\Models\Project::query()->where('charity',$charity)
                    ->where('is_active',1)
                    ->get(['id','title','image_head','pishraft'])
                ,
                'slider' => \App\Models\Slider::query()->where('charity',$charity)
                    ->where('is_active',1)->get()
                ,
                'hadis' => \App\Models\Hadis::query()->where('charity',$charity)->inRandomOrder()->first(),
            ],
            'status' => 'success'
        ]);
    }
}
