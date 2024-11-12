<?php

namespace App\Http\Controllers;


use App\Models\Invoice;
use App\Models\Invoicebody;
use App\Models\Stock;
use App\Models\Customer_Details;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice');
    }
    public function show($id)
    {
        // Retrieve the invoice by ID
        $invoice = Invoice::findOrFail($id);

        // Pass the invoice to the view
        return view('invoice', compact('invoice'));
    }


    public function fetchInvoices()
    {

        $invoices = Invoice::query();

        return DataTables::of($invoices)
            ->addIndexColumn()
            ->make(true);
    }
    public function fetchStocks(Request $request)
    {
        $query = Stock::query();


        return DataTables::of($query)->make(true);
    }

    public function createInvoice()
    {

        $lastInvoice = \App\Models\Invoice::latest('id')->first();
        $nextInvoiceNumber = $lastInvoice ? $lastInvoice->id + 1 : 1;
        $formattedInvoiceId = '' . $nextInvoiceNumber;
        return view('/invoice', compact('formattedInvoiceId'));
    }


    public function searchStock(Request $request)
    {
        $query = $request->input('query');

        $products = DB::table('stocks')
            ->where('Product_ID', 'like', "%{$query}%")
            ->orWhere('Product_Name', 'like', "%{$query}%")
            ->get();

        if ($products->isEmpty()) {
            return response()->json(['error' => 'No products found'], 404);
        }

        return response()->json($products);
    }


    //grid data and input data save to database

    public function store(Request $request)
    {
        // Validate the main invoice fields
        $request->validate([
            'invoice_id' => 'required|unique:invoices',
            'customer_name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'final_balance' => 'required|numeric|min:0',
            'customer_contact' => 'required|string',
            'date' => 'required|date',
        ]);

        // Create the main invoice record
        $invoice = Invoice::create([
            'invoice_id' => $request->invoice_id,
            'customer_name' => $request->customer_name,
            'total_amount' => $request->total_amount,
            'discount' => $request->discount,
            'final_balance' => $request->final_balance,
            'customer_contact' => $request->customer_contact,
            'date' => $request->date,
        ]);



        return response()->json(['success' => true, 'message' => 'Invoice and items saved successfully!']);
    }


    public function invoicebodystore(Request $request)
{
    $gridData = $request->input('grid_data');


    $validatedData = $request->validate([
        'invoice_id' => 'required|integer|exists:invoices,id',

    ]);


    foreach ($gridData as $item) {
        $productId = $item['product_id'];
        $quantity = $item['quantity'];


        $stock = \App\Models\Stock::where('Product_ID', $productId)->first();

        if (!$stock) {
            return response()->json(['error' => 'Product not found in stock.'], 404);
        }


        if ($stock->quantity < $quantity) {
            return response()->json(['error' => 'Not enough stock for product ' . $stock->Product_Name], 400);
        }


        $stock->quantity -= $quantity;
        $stock->save();


        \App\Models\InvoiceBody::create([
            'invoice_id' => $validatedData['invoice_id'],
            'product_id' => $item['product_id'],
            'product_name' => $item['product_name'],
            'company_name' => $item['company_name'],
            'price' => $item['price'],
            'quantity' => $quantity,
            'column_total' => $item['column_total'],
        ]);
    }

    return response()->json(['message' => 'Invoice body saved and stock updated successfully.'], 201);
}





public function getCustomers()
{
    $customers = Customer_Details::all();
    return response()->json($customers);
}


public function generatePDF(Request $request)
{

    $data = $request->all();

    $pdf = Pdf::loadView('invoicePDF', $data);


    return $pdf->download("Payment_Invoice_{$data['invoiceId']}.pdf");
}



public function getStocks()
{
    $stocks = Stock::all(['Product_ID', 'Product_Name', 'Company_Name', 'price']);
    return response()->json($stocks);
}





}
