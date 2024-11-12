<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductExtraDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('product_extra_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('stocks')->onDelete('cascade');
            $table->string('Product_Name')->nullable();
            $table->string('Company_Name')->nullable();
            $table->string('Weight')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_extra_details');
    }
}
