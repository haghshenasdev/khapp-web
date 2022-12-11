<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResurce;
use Illuminate\Http\Request;

class Slider extends Controller
{
    public function all($charity)
    {
        return new SliderResurce(\App\Models\Slider::all()
            ->where('is_active',1)
            ->where('charity',$charity)
        );
    }
}
