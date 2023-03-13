<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Faktoor;
use Illuminate\Http\Request;

class Pooyesh extends Controller
{
    public function index(Request $request, $charity)
    {
        $queryBase = \App\Models\Pooyesh::query()
            ->where('is_active', 1)
            ->where('charity', $charity);

        if ($request->has('id')){
            $data = $queryBase->findOrFail($request->input('id'))->toArray();
            if (!is_null($data['amount']) and $data['amount'] != 0){
                $data['persent_tamin']  = Faktoor::query()->where('is_pardakht',1)->where('type',$data['type_pay'])->where('charity',$charity)->sum('amount') * 100 / $data['amount'];
            }
            return [
                'data' => $data
            ];
        }

        return response()->json(
            ['data' => $queryBase->get()->makeHidden('description')]
        );
    }
}
