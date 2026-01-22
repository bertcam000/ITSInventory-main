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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->string('specs');
            $table->string('location');
            $table->enum('status', ['available', 'checked_out', 'under_maintenance', 'in use']);
            $table->enum('category', ['laptop', 'desktop', 'monitor', 'printer', 'other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
