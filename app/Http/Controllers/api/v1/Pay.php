<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\charity;
use App\Models\Faktoor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Omalizadeh\MultiPayment\Exceptions\PaymentAlreadyVerifiedException;
use Omalizadeh\MultiPayment\Exceptions\PaymentFailedException;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;
use function PHPUnit\Framework\isNull;

class Pay extends Controller
{

    public function pay(Request $request,$charity)
    {
        $request->validate([
            'type' => ['required','numeric'],
            'amount' => ['required','numeric']
        ]);

        $user = Auth::user();
        $sabtId = '110-' . Str::random(9);

        $faktoorId = Faktoor::query()->insertGetId([
            'userid' => $user->id,
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
            'sabtid' => $sabtId,
            'charity' => $charity,
        ]);

        return response()->json([
            'url' => url('/invoice/'.$sabtId),
            'faktoorId' => $faktoorId,
        ]);
    }

    public function verify(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'faktoorId' => ['required','numeric'],
        ]);

        // Get amount & transaction_id from database or gateway request
        $fk = Faktoor::query()->findOrFail($request->faktoorId);

        $data = [
            'is_pardakht' => false,
        ];

        if ($fk->is_pardakht){
            $data['is_pardakht'] = true;
            $data['ResNum'] = $fk->ResNum;
        }

        return response()->json($data);

    }
}
