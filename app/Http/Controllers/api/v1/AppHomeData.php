<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppHomeDataResource;
use App\Models\CharitiesMeta;
use App\Models\HomeItem;
use App\Models\Pooyesh;
use App\queries\Queries;
use Illuminate\Support\Facades\Http;

class AppHomeData extends Controller
{
    public function index($charity)
    {
        $homeItem = Queries::getHomeItems(true,$charity)->get();
        foreach ($homeItem as $item){
            $item->action = json_decode($item->action);
        }

        return response()->json([
            'data' => [
                'homeItems' => $homeItem
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

    public function about($charity)
    {
        return response()->json(
            Queries::getCharityAndMetas()->where('charity',$charity)->get()->makeHidden(['authority','is_active','charity']),
        );
    }
}
