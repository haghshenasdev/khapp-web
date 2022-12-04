<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use Omalizadeh\MultiPayment\Facades\PaymentGateway;
use Omalizadeh\MultiPayment\Invoice;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[Home::class,'show']);
Route::get('/pay',function (){
    $invoice = new Invoice(10000);
    $invoice->setPhoneNumber("989123456789");

    return PaymentGateway::purchase($invoice, function (string $transactionId) {
        // Save transaction_id and do stuff...
    })->view();
});
