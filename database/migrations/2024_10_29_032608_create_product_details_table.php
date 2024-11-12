<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('stocks')->onDelete('cascade');
            //$table->string('Product_ID');
            $table->date('Manufacture_Date');
            $table->date('Expiration_Date');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
