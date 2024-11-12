<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExtraDetails extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'product_id',
        'Product_ID',
        'Product_Name',
        'Company_Name',
        'Weight',
        
    ];

    // Define the relationship with the Stock model
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'product_id');
    }
}
