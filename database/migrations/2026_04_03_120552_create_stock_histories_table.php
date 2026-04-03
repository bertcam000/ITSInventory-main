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
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            // RELATION
            $table->foreignId('stock_id')->constrained()->cascadeOnDelete();

            // ACTION TYPE
            $table->string('type'); 
            // initial, stock_in, stock_out, adjustment

            // QUANTITY TRACKING
            $table->integer('quantity'); // amount added/removed
            $table->integer('previous_quantity');
            $table->integer('new_quantity');

            // CONTEXT
            $table->string('reference_no')->nullable(); // DR, request no, etc.
            $table->string('issued_to')->nullable(); // employee / department
            $table->string('department')->nullable(); // optional
            $table->text('remarks')->nullable(); // reason / notes

            // AUDIT
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_histories');
    }
};
