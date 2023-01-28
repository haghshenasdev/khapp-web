<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Pooyesh extends Controller
{
    public function index(Request $request, $charity)
    {
        $queryBase = \App\Models\Pooyesh::query()
            ->where('is_active', 1)
            ->where('charity', $charity);

        if ($request->has('id')){
            return [
                'data' => $queryBase->findOrFail($request->input('id'))
            ];
        }

        return response()->json(
            ['data' => $queryBase->get()->makeHidden('description')]
        );
    }
}
