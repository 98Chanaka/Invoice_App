<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Invoice;

class PaymentController extends Controller
{
    public function store(Request $request)
{
    error_log("Payment processing started.");


    $validatedData = $request->validate([
        'invoice_id' => 'required|exists:invoices,id',
        'payment_method' => 'required|string',
        'payment_amount' => 'required|numeric|min:0',
        'payment_date' => 'required|date',
    ]);


    $invoice = Invoice::find($validatedData['invoice_id']);


    // if ($validatedData['payment_amount'] != $invoice->final_balance) {

    //     return response()->json(['error' => 'The payment amount does not match the final balance.'], 422);
    // }


    Payment::create($validatedData);


    return response()->json(['message' => 'Payment successfully recorded.'], 200);
}

}
