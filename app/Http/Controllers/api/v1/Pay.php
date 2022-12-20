<?php

namespace App\Http\Controllers\api\v1;

use App\Models\charity;
use App\Models\Faktoor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;

class Pay
{
    public function invoice($charity,$sabtid)
    {
        $faktoor = Faktoor::query()->where('sabtid',$sabtid)->first();

        $invoice = new Invoice($faktoor->amount);
        $invoice->setPhoneNumber(\App\Models\User::query()->find($faktoor->userid,'phone')->phone);

        return PaymentGateway::purchase($invoice, function (string $transactionId) {

        })->view();
    }

    public function pay(Request $request,$charity)
    {
        $request->validate([
            'type' => ['required','numeric'],
            'amount' => ['required','numeric']
        ]);

        $user = Auth::user();
        $sabtId = '110-' . Str::random(9);

        Faktoor::query()->insert([
            'userid' => $user->id,
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
            'sabtid' => $sabtId,
            'charity' => $charity,
        ]);

        return response()->json([
            'url' => url('api/v1/'.$charity.'/invoice/'.$sabtId),
        ]);
    }

//    public function verifay()
//    {
//        try {
//            // Get amount & transaction_id from database or gateway request
//            $invoice = new Invoice($amount, $transactionId);
//            $receipt = PaymentGateway::verify($invoice);
//            // Save receipt data and return response
//            //
//        } catch (PaymentAlreadyVerifiedException $exception) {
//            // Optional: Handle repeated verification request
//        } catch (PaymentFailedException $exception) {
//            // Handle exception for failed payments
//            return $exception->getMessage();
//        }
//    }
}
