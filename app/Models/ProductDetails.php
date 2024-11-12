<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'Product_ID',
        'Manufacture_Date',
        'Expiration_Date'
    ];


    //relationship with stock table
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'product_id');
    }
}
