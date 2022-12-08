<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\hadisresource;
use Illuminate\Http\Request;

class Hadis extends Controller
{
    public function getById($id = null)
    {
        $data = [];
        if ($id == null){
            $data = \App\Models\Hadis::all();
        }else{
            $data = \App\Models\Hadis::where('id',$id)->first();
        }
        return new hadisresource($data);
    }

    public function random()
    {
        return new hadisresource(\App\Models\Hadis::inRandomOrder()->first());
    }
}
