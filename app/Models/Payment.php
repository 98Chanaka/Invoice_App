<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'payment_method',
        'payment_amount',
        'payment_date',
    ];

    // Define a relationship if needed
    public function invoice()
    {
        return $this->belongsTo(Invoice::class); 
    }
}
