<?php

namespace App\Http\Controllers\api\v1\profile;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Darkhast extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => \App\Models\Darkhast::query()
                ->where('user',Auth::id())
                ->join('darkhast_types', 'darkhasts.type','=','darkhast_types.id')
                ->get(['darkhasts.id','darkhasts.description','darkhasts.created_at','darkhasts.updated_at','darkhasts.status','darkhast_types.title']),
        ]);
    }

    public function type($charity,Request $request): \Illuminate\Http\JsonResponse
    {
        if ($sub = $request->input('sub'))
        {
            return response()->json([
                'data' => \App\Models\DarkhastType::all()
                    ->where('is_active',1)
                    ->where('charity',$charity)
                    ->where('sub',$sub)
            ]);
        }

        if ($request->has('id') && $dataType = \App\Models\DarkhastType::query()
            ->where('id',$request->input('id'))
            ->where('is_active',1)
            ->where('charity',$charity)->first()
        ){
            return  response()->json([
                'data' => $dataType
            ]);
        }


        return  response()->json(
            [
                'data' => \App\Models\DarkhastType::all()
                ->where('is_active',1)
                ->where('charity',$charity)
                ->where('sub',null)
            ]
        );
    }

    public function create($charity,Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'type' => ['required','numeric'],
            'description' => ['string'],
        ]);

        try {
            \App\Models\Darkhast::query()->insert([
                'type' => $request->input('type'),
                'user' => Auth::id(),
                'description' => $request->input('description'),
                'charity' => $charity,
            ]);

            return response()->json([
                'message' => 'درخواست با موفقیت ایجاد شد',
                'status' => 'success'
            ]);

        }catch (Exception $exception){

            return response()->json([
                'message' => 'درخواست ایجاد نشد',
                'error' => $exception->getMessage(),
                'status' => 'error'
            ]);

        }
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => ['required','numeric']
        ]);

        try {
            \App\Models\Darkhast::query()
                ->where('id',$request->input('id'))
                ->where('user',Auth::id())->delete();

            return response()->json([
                'message' => 'در خواست مورد نظر با موفقیت حذف شد.',
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

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => ['required','numeric'],
            'type' => ['numeric'],
            'description' => ['string'],
        ]);

        $data = [];
        if ($request->has('type')){
            $data['type'] = $request->input('type');
        }
        if ($request->has('description')){
            $data['description'] = $request->input('description');
        }

        try {
            \App\Models\Darkhast::query()->where('id',$request->input('id'))->update($data);

            return response()->json([
                'message' => 'در خواست مورد نظر با موفقیت بروزرسانی شد.',
                'status' => 'success'
            ]);
        }catch (Exception $exception){
            return response()->json([
                'message' => 'بروزرسانی انجام نشد!',
                'error' => $exception->getMessage(),
                'status' => 'error'
            ]);
        }
    }
}
