<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceBody extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',      // Add this line
        'product_id',
        'product_name',
        'company_name',
        'price',
        'quantity',
        'column_total',
    ];
}
