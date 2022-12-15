<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Darkhast;
use App\Models\Faktoor;
use Illuminate\Support\Facades\Auth;

class Profile
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'charity' => $user->charity,
            ],
        ]);
    }

    public function faktoors(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => Faktoor::query()
                ->where('userid',Auth::user()->id)
                ->join('types','faktoors.type','=','types.id')
                ->get()->makeHidden(['description','is_active','sub','type_name','type','userid'])
        ]);
    }

    public function darkhasts(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => Darkhast::query()
                ->where('user',Auth::user()->id)
                ->join('darkhast_types', 'darkhasts.type','=','darkhast_types.id')
                ->get(['darkhasts.id','darkhasts.description','darkhasts.date','darkhasts.status','darkhast_types.title']),
        ]);
    }
}
