<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks'; // Specify the table name
    protected $primaryKey = 'id'; // Primary key
    protected $fillable = [
        'id',
        'Product_ID', //add to product code
        'Product_Name',
        'Company_Name',
        'Weight',
        'Manufacture_Date',
        'Expiration_Date',
        'quantity',
        'price',
        'Image',

    ];

    // Relationship with ProductDetails
    public function productDetails()
    {
        return $this->hasOne(ProductDetails::class, 'product_id');
    }
}
