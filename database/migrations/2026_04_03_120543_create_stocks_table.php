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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            // IDENTIFICATION
            $table->string('item_name'); // e.g. Screw Driver, Mouse
            $table->string('item_code')->unique(); // e.g. TOOL-0001
            $table->string('category'); // Tools, Accessories, Network, Cleaning

            // DETAILS
            $table->string('brand')->nullable(); // Logitech, TP-Link
            $table->string('model')->nullable();
            $table->string('specification')->nullable(); // optional description

            // QUANTITY
            $table->integer('quantity')->default(0);
            $table->integer('minimum_stock')->default(5); // alert threshold
            $table->string('unit')->default('pcs'); // pcs, box, set

            // LOCATION
            $table->string('location')->default('Stock Room'); // Storage location

            // STATUS (optional but useful)
            $table->string('status')->default('in_stock'); 
            // in_stock, low_stock, out_of_stock

            // TRACKING
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
