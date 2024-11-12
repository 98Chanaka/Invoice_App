<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_bodies', function (Blueprint $table) {
            $table->id();

            // Foreign key for the invoices table
            $table->unsignedBigInteger('invoice_id'); // Assuming invoice_id is an integer and foreign key
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            // Other fields
            $table->string('product_id');
            $table->string('product_name');
            $table->string('company_name');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('column_total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_bodies');
    }
}
