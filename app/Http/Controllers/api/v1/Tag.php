<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Marasem;
use App\Models\TagType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;


class Tag extends Controller
{

    public function getTagType(Request $request, $charity)
    {
        $queryBase = \App\Models\TagType::query()
            ->where('is_active', 1)
            ->where('charity', $charity);

        if ($request->has('id')){
            $queryBase->where('id',$request->integer('id'))->first();
        }

        return response()->json([
            'data' => $queryBase->get()
        ]);
    }

    public function getTagTarh(Request $request, $charity)
    {
        $queryBase = \App\Models\TagTarh::query()
            ->where('is_active', 1)
            ->where('charity', $charity)
            ->select(['id','name','img']);

        if ($request->has('id')){
            $queryBase->where('id',$request->integer('id'))->first();
        }

        return response()->json([
            'data' => $queryBase->get()
        ]);
    }

    public function getUserOrder(Request $request, $charity)
    {
        $queryBase = \App\Models\Tag::query()
            ->where('tags.user', Auth::id())
            ->where('tags.charity', $charity)
            ->leftJoin('faktoors','tags.payed','=','faktoors.id')
            ->Join('marasems','tags.marasem','=','marasems.id')
            ->select(['tags.id','tags.bename','tags.status','tags.created_at','marasems.marhoom_name','faktoors.is_pardakht','faktoors.sabtid']);


        if ($request->has('id')){
            $queryBase->where('id',$request->integer('id'))->first();
        }

        return response()->json([
            'data' => $queryBase->get()
        ]);
    }

    public function createOrder(Request $request, $charity)
    {
        $validData = $request->validate([
            'bename' => ['required','string'],
            'marasem' => ['required','exists:marasems,id'],
            'type' => ['required','exists:tag_types,id'],
            'tarh' => ['required','exists:tag_tarhs,id'],
        ]);

//        $this->checkCount();
//        $this->checkDate();

        $request->merge([
            'type' => '4',
            'amount' => TagType::query()->find($validData['type'])->amount,
        ]);
        $pay = new Pay();
        $payData = $pay->pay($request,$charity);

        $orderID = \App\Models\Tag::query()->insertGetId([
            'user' => Auth::id(),
            'marasem' => $validData['marasem'],
            'type' => $validData['type'],
            'tarh' => $validData['tarh'],
            'bename' => $validData['bename'],
            'charity' => $charity,
            'payed' => $payData->getData()->faktoorId,
            'created_at' => Date::now()
        ]);


        return response()->json([
            'data' => [
                'order_id' => $orderID,
                'pay_data' => $payData->getData()
            ]
        ]);
    }

    public function editOrder()
    {

    }

    public function deleteOrder()
    {

    }

    public function payOrder(Request $request, $charity)
    {
        $validData = $request->validate([
            'order_id' => ['required','exists:marasems'],
        ]);

        $order = \App\Models\Tag::query()->find($validData['order_id']);

        // payed is null
        $request->merge([
            'type' => '4',
            'amount' => TagType::query()->find($order->type)->amount,
        ]);
        $pay = new Pay();
        $payData = $pay->pay($request,$charity);
        $order->payed = $pay->faktoorId;
        $order->save();

        return $payData;
    }

    private function checkCount($charity,$tag_type,$date)
    {
        $count = \App\Models\Tag::query()
            ->where('charity',$charity)
            ->where('payed','!=',null)
            ->join('marasems','tags.marasem')
            ->join('tag_typs','tags.type')
            ->where('tag_typs',$tag_type->id)
            ->whereDate('marasem.date',$date)
            ->count();

        if ($count >= $tag_type->count){
            $msg = 'تعداد این نوع تاج گل برای این تاریخ به اتمام رسیده است!';
        }
    }

    private function checkDate($marasemDate)
    {
        $date =  Date::now();
        if ($date <= $marasemDate){

        }
    }

}
