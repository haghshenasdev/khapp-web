<?php

namespace App\Http\Controllers;

use App\Models\Faktoor;
use Illuminate\Http\Request;
use Omalizadeh\MultiPayment\Exceptions\PaymentAlreadyVerifiedException;
use Omalizadeh\MultiPayment\Exceptions\PaymentFailedException;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;

class Pay extends Controller
{
    public function invoice($sabtid)
    {
        $faktoor = Faktoor::query()->where('sabtid',$sabtid)->first();

        $invoice = new Invoice($faktoor->amount);
        $invoice->setPhoneNumber(\App\Models\User::query()->find($faktoor->userid,'phone')->phone);

        return PaymentGateway::purchase($invoice, function (string $transactionId) use ($sabtid) {
            Faktoor::query()->where('sabtid',$sabtid)->update(['ResNum' => $transactionId]);
        })->view();
    }

    public function verify(Request $request)
    {
        try {
            // Get amount & transaction_id from database or gateway request
            $invoice = new Invoice($request->Amount,$request->ResNum);
            $receipt = PaymentGateway::verify($invoice);
            // Save receipt data and return response
            //
            Faktoor::query()->where('ResNum',$request->ResNum)->update(['is_pardakht' => 1]);
            return view('verifypay',[
                'message' => 'پرداخت موفقیت آمیز بود.',
                'receipt' => [
                    'CardNumber' => $receipt->getCardNumber(),
                    'InvoiceId' => $receipt->getInvoiceId(),
                    'ReferenceId' => $receipt->getReferenceId(),
                    'TraceNumber' => $receipt->getTraceNumber(),
                    'TransactionId' => $receipt->getTransactionId(),
                ],
            ]);
        } catch (PaymentAlreadyVerifiedException $exception) {
            // Optional: Handle repeated verification request
            return view('verifypay',['message' => 'خطا در برسی پرداخت .']);
        } catch (PaymentFailedException $exception) {
            // Handle exception for failed payments
            return view('verifypay',['message' => $exception->getMessage(),]);
        }
    }
}
