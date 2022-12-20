<?php

namespace App\Http\Controllers\api\v1;

use App\Models\charity;
use App\Models\Faktoor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;

class Pay
{
    public function index(Request $request,$charity)
    {
        $request->validate([
            'type' => ['required','numeric'],
            'amount' => ['required','numeric']
        ]);

        $user = Auth::user();
        $invoice = new Invoice($request->input('amount'));
        $invoice->setPhoneNumber($user->phone);

        return PaymentGateway::purchase($invoice, function (string $transactionId) use ($request, $charity, $user) {
            Faktoor::query()->insert([
                'userid' => $user->id,
                'amount' => $request->input('amount'),
                'type' => $request->input('type'),
                'sabtid' => $transactionId,
                'charity' => $charity,
            ]);
        })->view();
//            return response()->json([
//                'data' => ->name,
//                'charity' => $charity
//            ]);
    }
}
