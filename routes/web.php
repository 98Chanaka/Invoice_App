<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PaymentController;
use App\Models\Invoice;
use GuzzleHttp\Middleware;

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

// Route::get('/', function () {
//     return view('/login');
// });

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'index'])->name('login.submit');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => [ 'auth','admin']], function(){


    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store');
    Route::get('/stock/fetch', [StockController::class,  'fetch'])->name('stock.fetch');
    Route::get('/stock/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
    Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.update');
    Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');
    //Route::get('/send-email/{id}', [StockController::class, 'sendEmail'])->name('send.email');
    Route::post('/send-email/{id}', [StockController::class, 'sendEmail'])->name('send.email');



    Route::get('/invoice',[InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/fetch-invoices', [InvoiceController::class, 'fetchInvoices'])->name('fetch.invoices');
    Route::get('/fetch-stocks', [InvoiceController::class, 'fetchStocks'])->name('fetch.stocks');
    Route::get('/fetch-product-details', [InvoiceController::class, 'fetchProductDetails'])->name('fetch.product.details');
    Route::get('/invoice', [InvoiceController::class, 'createInvoice'])->name('invoice.create');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/search-stock', [InvoiceController::class, 'searchStock'])->name('searchStock');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/update-quantity', [InvoiceController::class, 'updateQuantity'])->name('update.quantity');
    Route::get('/get-customers', [InvoiceController::class, 'getCustomers'])->name('getCustomers');
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'showInvoice'])->name('show.Invoice');
    Route::get('/api/stocks', [InvoiceController::class, 'getStocks'])->name('getstocks');
    Route::get('/invoice/{invoice_id}', [InvoiceController::class, 'generateInvoice'])->name('invoice.generate');
    Route::post('/save-invoice-body', [InvoiceController::class, 'invoicebodystore'])->name('invoicebody.store');
    Route::post('/generate-invoice-pdf', [InvoiceController::class, 'generatePDF'])->name('generate.invoice.pdf');
    //Route::post('/update-product-stock', [InvoiceController::class, 'updateProductStock'])->name('update.product.stock');
    Route::post('/update-product-stock', [InvoiceController::class, 'updateProductStock']);




    Route::post('/update-final-balance', [PaymentController::class, 'updateFinalBalance'])->name('update.final.balance');
    Route::post('/payments', [PaymentController::class, 'store'])->name('update.payment');

});









