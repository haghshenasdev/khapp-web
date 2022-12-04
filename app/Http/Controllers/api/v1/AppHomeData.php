<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppHomeDataResource;

class AppHomeData extends Controller
{
    public function index($charity)
    {
        return AppHomeDataResource::collection();
    }
}
