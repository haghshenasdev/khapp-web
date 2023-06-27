<?php

namespace App\Http\Controllers\api\v1;

use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Blog
{
    public function getPosts(Request $request,$charity)
    {
        $queryBase = \App\Models\Post::query()
            ->where('is_active', 1)
            ->where('charity', $charity)->select(['id','created_at','img','title','body']);

        if ($request->has('id')){
            $queryBase->where('id',$request->integer('id'))->first();
        }

        return response()->json([
            'data' => $queryBase->get()
        ]);
    }
}
