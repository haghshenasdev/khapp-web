<?php

namespace App\Http\Controllers;

use App\Models\charity;
use App\Models\Faktoor;
use App\Models\User;
use App\queries\Queries;
use Illuminate\Http\Request;
use Omalizadeh\MultiPayment\Exceptions\PaymentAlreadyVerifiedException;
use Omalizadeh\MultiPayment\Exceptions\PaymentFailedException;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;

class Pay extends Controller
{
    public function invoice($sabtid)
    {
        $faktoor = Faktoor::query()->where('sabtid',$sabtid)->firstOrFail();

        if ($faktoor->is_pardakht != 1 ) {
            // for admin pay test
            if($this->isUserFaktoorAdmin($faktoor)){
                $faktoor->is_pardakht = 1;
                $faktoor->save();
                return view('pay.verify',[
                    'message' => 'فاکتور جهت تست پرداخت شد .',
                    'success' => true,
                    'charity' => charity::query()
                        ->find($faktoor->charity,'shortname')
                        ->shortname]
                );
            }else{
                $this->configPaymentBuyDatabaseData($faktoor->charity);

                $invoice = new Invoice($faktoor->amount);
                $invoice->setPhoneNumber(\App\Models\User::query()->find($faktoor->userid,'phone')->phone);

                return PaymentGateway::purchase($invoice, function (string $transactionId) use ($sabtid) {
                    Faktoor::query()->where('sabtid',$sabtid)->update(['ResNum' => $transactionId]);
                })->view();
            }

        }

        return view('pay.verify',[
            'message' => 'این فاکتور قبلا پرداخت شده است.',
            'success' => true,
            'charity' => charity::query()
                ->find($faktoor->charity,'shortname')
                ->shortname,
            'data' => $faktoor,
        ]);
    }

    public function verify(Request $request)
    {
        try {
            // Save receipt data and return response
            //
            $fk = Faktoor::where('ResNum',$request->ResNum)->first();
            $this->configPaymentBuyDatabaseData($fk->charity);
            // Get amount & transaction_id from database or gateway request
            $invoice = new Invoice($request->Amount,$request->ResNum);
            $receipt = PaymentGateway::verify($invoice);

            $fk->is_pardakht = 1;
            $fk->save();

            return view('pay.verify',[
                'message' => 'پرداخت موفقیت آمیز بود.',
                'success' => true,
                'charity' => charity::query()
                    ->find($fk->charity,'shortname')
                    ->shortname,
                'receipt' => [
                    'CardNumber' => $receipt->getCardNumber(),
                    'InvoiceId' => $receipt->getInvoiceId(),
                    'ReferenceId' => $receipt->getReferenceId(),
                    'TraceNumber' => $receipt->getTraceNumber(),
                ],
            ]);
        } catch (PaymentAlreadyVerifiedException $exception) {
            // Optional: Handle repeated verification request
            return view('pay.verify',['message' => 'خطا در برسی پرداخت .']);
        } catch (PaymentFailedException $exception) {
            // Handle exception for failed payments
            return view('pay.verify',['message' => $exception->getMessage(),]);
        }
    }

    private function configPaymentBuyDatabaseData($charity)
    {
        $terminalID = Queries::getCharityTerminalid($charity);

        if (!is_null($terminalID)) config()->set('gateway_saman.main.terminal_id',$terminalID);
    }

    private function isUserFaktoorAdmin(Faktoor $faktoor)
    {
        return User::query()->find($faktoor->userid,'access_level')->access_level == 0;
    }
}
