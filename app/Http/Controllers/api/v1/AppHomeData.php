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
                'homeItems' => (new HomeItem)->AllByCharity($charity),
                'pooyeshes' => (new \App\Models\Pooyesh)->AllByCharity($charity),
                'projects' => (new \App\Models\Pooyesh)->AllByCharity($charity),
                'slider' => (new \App\Models\Slider)->AllByCharity($charity),
                'hadis' => \App\Models\Hadis::where('charity',$charity)->inRandomOrder()->first(),
            ]
        ]);
    }
}
