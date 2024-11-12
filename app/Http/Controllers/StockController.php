<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Models\ProductDetails;
use App\Models\ProductExtraDetails;
use Error;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
// sent to mail function
//use App\Mail\ProductEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class StockController extends Controller
{

    public function index()
    {
        return view('stock');
    }

    public function fetch(Request $request)
    {
        if (!$request->isMethod('get')) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        if ($request->ajax()) {
            $data = Stock::get();
            return DataTables::of($data)
                ->addColumn('action', function($row) {

                    $btn = '<div class="d-flex justify-content-start align-items-center">';
                    $btn .= '<a onclick="editProduct(' . $row->id . ')" class="edit btn btn-success btn-sm mr-2">Edit</a>';
                    $btn .= '<a onclick="deleteProduct(' . $row->id . ')" class="delete btn btn-danger btn-sm mr-2">Delete</a>';
                    $btn .= '<button onclick="sendEmail(' . $row->id . ')" class="btn btn-info btn-sm">Email</button>';

                    //$btn .= '<a onclick="buyProduct(' . $row->id . ')" class="buy btn btn-danger btn-sm mr-2">buy</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->toJson();
        }

        return view('stock');
    }

    //fetch to invoice table data
    public function getStocks()
    {
        $stocks = Stock::all(); // Fetch all stocks
        return response()->json($stocks);
    }




    public function show($id)
    {
        $product = Stock::findOrFail($id);
        return response()->json($product);
    }


    public function store(Request $request)
    {
        // Log for debugging
        error_log('Processing the store function');

        // Validate request data
        $request->validate([
            'Product_ID' => 'required|string',
            'Product_Name' => 'required|string',
            'Company_Name' => 'required|string',
            'Weight' => 'required|string|max:255',
            'Manufacture_Date' => 'required|date',
            'Expiration_Date' => 'required|date',
            'quantity' => 'required',
            'price' => 'required|string',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('Image')) {
            $imagePath = $request->file('Image')->store('/images', 'public');
        }

        // Check if updating an existing product
        $existingProduct = Stock::find($request->ID);
        if ($existingProduct) {
            // Retain the existing image if no new image is uploaded
            $imagePath = $imagePath ?? $existingProduct->Image;
        }

        // Update or create the record
        $product = Stock::updateOrCreate(
            ['id' => $request->ID],
            [
                'Product_ID' => $request->Product_ID,
                'Product_Name' => $request->Product_Name,
                'Company_Name' => $request->Company_Name,
                'Weight' => $request->Weight,
                'Manufacture_Date' => $request->Manufacture_Date,
                'Expiration_Date' => $request->Expiration_Date,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'Image' => 'storage/'.$imagePath

            ]
        );

        // Create or update the ProductDetails table with related data
        ProductDetails::updateOrCreate(
            ['product_id' => $product->id], // Link to the Stock entry via product_id
            [
                'Manufacture_Date' => $request->Manufacture_Date,
                'Expiration_Date' => $request->Expiration_Date,

            ]
        );

        // Create or update the ProductExtraDetails table with related data
        ProductExtraDetails::updateOrCreate(
            ['product_id' => $product->id], // Link to the Stock entry via product_id
            [

                'Product_Name' => $request->Product_Name,
                'Company_Name' => $request->Company_Name,
                'Weight' => $request->Weight,

            ]
        );

        error_log('Store function processed successfully');


        return response()->json(['message' => 'Product saved successfully!', 'data' => $product]);
    }

    public function edit($id)
        {
            $product = Stock::findOrFail($id);
            return response()->json($product);
        }


    public function update(StockRequest $request, $id)
        {
            try {
                error_log('Processing the update function for ID: ' . $id);

                $existingProduct = Stock::findOrFail($id);

                // Handle image upload
                $imagePath = $existingProduct->Image; // Retain old image path by default
                if ($request->hasFile('Image')) {
                    // Delete the old image if it exists
                    if ($existingProduct->Image && Storage::disk('public')->exists($existingProduct->Image)) {
                        Storage::disk('public')->delete($existingProduct->Image);
                    }

                    // Store the new image
                    $imagePath = $request->file('Image')->store('/images', 'public');
                }

                // Update the product details
                $existingProduct->update([
                    'Product_ID' => $request->Product_ID,
                    'Product_Name' => $request->Product_Name,
                    'Company_Name' => $request->Company_Name,
                    'Weight' => $request->Weight,
                    'Manufacture_Date' => $request->Manufacture_Date,
                    'Expiration_Date' => $request->Expiration_Date,
                    'quantity' => $request->quantity,
                    'Image' => 'storage/' . $imagePath, // Store image path
                    'price' => $request->price,
                ]);


                //Update the associated ProductDetails record
            ProductDetails::updateOrCreate(
                ['product_id' => $existingProduct->id],
                [
                    'Manufacture_Date' => $request->Manufacture_Date,
                    'Expiration_Date' => $request->Expiration_Date,
                ]
            );


            //update the associated ProductExtraDetails record

            ProductExtraDetails::updateOrCreate(
                ['product_id' => $existingProduct->id],
                [
                    'Product_Name' => $request->Product_Name,
                    'Company_Name' => $request->Company_Name,
                    'Weight' => $request->Weight,
                ]
            );


                error_log('Update function processed successfully for ID: ' . $id);
                return response()->json(['message' => 'Product updated successfully!', 'data' => $existingProduct]);
            } catch (\Exception $e) {
                error_log('Error updating product: ' . $e->getMessage());
                return response()->json(['message' => 'Failed to update product!'], 500);
            }
        }



        public function destroy($id)
        {
            try {

                $product = Stock::findOrFail($id);

                //delete to Product Details table data
                ProductDetails::where('product_id', $product->id)->delete();
                //delete to Product Extra Details table data
                ProductExtraDetails::where('product_id', $product->id)->delete();

                if ($product->Image && Storage::disk('public')->exists($product->Image)) {
                    Storage::disk('public')->delete($product->Image);
                }
                $product->delete();

                return response()->json(['message' => 'Product and its details deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error occurred while deleting Product: ' . $e->getMessage()], 500);
            }
        }


        public function sendEmail(Request $request, $id)
        {
            $request->validate([
                'email' => 'required|email',
            ]);

            $email = $request->email;

            try {
                // Send the email (customize your email view and data)
                Mail::to($email)->send(new TestEmail($id));

                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }
        }





}
