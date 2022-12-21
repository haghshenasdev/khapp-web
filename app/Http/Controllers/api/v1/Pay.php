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

    public function verify(Request $request)
    {
        $request->validate([
            'faktoorId' => ['required','numeric'],
        ]);

        try {
            // Get amount & transaction_id from database or gateway request
            $fk = Faktoor::query()->find(3);
            if (isNull($fk)){
                return response()->json([
                    'message' => 'فاکتور یافت نشد.',
                    'status' => 'error'
                ]);
            }
            $invoice = new Invoice($fk->amount,$fk->ResNum);
            $receipt = PaymentGateway::verify($invoice);
            // Save receipt data and return response
            //
            if ($fk->is_pardakht == 0){
                $fk->update(['is_pardakht' => 1]);
            }
            return response()->json([
                'message' => 'پرداخت موفقیت آمیز بود.',
                'status' => 'success',
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
        } catch (PaymentFailedException $exception) {
            // Handle exception for failed payments
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 'error'
            ]);
        }
    }
}
