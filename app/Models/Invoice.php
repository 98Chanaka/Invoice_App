<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [

            'invoice_id',
            'customer_name',
            'total_amount',
            'Status',
            'discount',
            'final_balance',



    ];
    public function invoiceBodies()
    {
        return $this->hasMany(InvoiceBody::class, 'invoice_id');
    }

}
