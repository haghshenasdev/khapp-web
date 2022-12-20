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
        $user = Auth::user();
        $invoice = new Invoice(10000);
        $invoice->setPhoneNumber($user->phone);

        return PaymentGateway::purchase($invoice, function (string $transactionId) use ($request, $charity, $user) {
            Faktoor::query()->insert([
                'userid' => $user->id,
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
