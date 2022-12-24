<?php

namespace App\Http\Controllers\api\v1\profile;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Faktoor extends Controller
{
    public function faktoors(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => \App\Models\Faktoor::query()
                ->where('userid',Auth::user()->id)
                ->join('types','faktoors.type','=','types.id')
                ->get()->makeHidden(['description','is_active','sub','type_name','type','userid'])
        ]);
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => ['required','numeric']
        ]);

        try {
            \App\Models\Faktoor::query()
                ->where('id',$request->input('id'))
                ->where('userid',Auth::id())->delete();

            return response()->json([
                'message' => 'فاکتور مورد نظر با موفقیت حذف شد.',
                'status' => 'success'
            ]);
        }catch (Exception $exception){
            return response()->json([
                'message' => 'حذف انجام نشد!',
                'error' => $exception->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    public function dlimg()
    {

    }
}
