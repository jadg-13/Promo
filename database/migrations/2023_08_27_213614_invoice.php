<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('invoices', function(Blueprint $table){
            $table->id();
            $table->integer('id_customer');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('identification');
            $table->string('phone');
            $table->string('invoice_number');
            $table->string('code');
            $table->string('point_sale');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('invoices');
    }
};
