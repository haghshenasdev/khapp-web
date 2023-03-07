<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppHomeDataResource;
use App\Models\CharitiesMeta;
use App\Models\HomeItem;
use App\Models\Pooyesh;
use App\queries\Queries;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
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
                    ->where(function ($q){
                        $q->where('start','<=',Carbon::now()->format('Y-m-d H:i:s'))->orWhere('start',null);
                    })->where(function ($q){
                        $q->where('end','>',Carbon::now()->format('Y-m-d H:i:s'))->orWhere('end',null);
                    })
                    ->get(['id','title','image'])
                ,
                'projects' => \App\Models\Project::query()->where('charity',$charity)
                    ->where('is_active',1)
                    ->get(['id','title','image_head','pishraft'])
                ,
                'slider' => Queries::getSliders($charity)->get('image')
                ,
                'hadis' => Queries::getRandomHadis($charity),
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
