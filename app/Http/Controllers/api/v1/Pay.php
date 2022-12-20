<?php

namespace App\Http\Controllers\api\v1;

use App\Models\charity;
use App\Models\Faktoor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Omalizadeh\MultiPayment\Exceptions\PaymentAlreadyVerifiedException;
use Omalizadeh\MultiPayment\Exceptions\PaymentFailedException;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;

class Pay
{
    public function invoice($charity,$sabtid)
    {
        $faktoor = Faktoor::query()->where('sabtid',$sabtid)->first();

        $invoice = new Invoice($faktoor->amount);
        $invoice->setPhoneNumber(\App\Models\User::query()->find($faktoor->userid,'phone')->phone);

        return PaymentGateway::purchase($invoice, function (string $transactionId) use ($sabtid) {
           // Faktoor::query()->where('sabtid',$sabtid)->update(['transactionId' => $transactionId]);
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

    public function verify(Request $request)
    {
        try {
            //dd($request);
            // Get amount & transaction_id from database or gateway request
            $invoice = new Invoice($request->Amount,$request->ResNum);
            $receipt = PaymentGateway::verify($invoice);
            // Save receipt data and return response
            //
            return response()->json([
                'message' => 'موفقیت آمیز بود'
            ]);
        } catch (PaymentAlreadyVerifiedException $exception) {
            // Optional: Handle repeated verification request
        } catch (PaymentFailedException $exception) {
            // Handle exception for failed payments
            return $exception->getMessage();
        }
    }
}
