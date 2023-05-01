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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->date('sale_date')->default(now());
            $table->double('subtotal', 9, 2);
            $table->double('iva', 9, 2);
            $table->double('total', 9, 2);
            $table->unsignedBigInteger('id_payment_method')->nullable();
            $table->foreign('id_client')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('id_payment_method')->references('id')->on('payment_methods')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
