<?php

use App\Models\Monitor;
use App\Models\Pc;
use App\Models\SystemUnit;
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
        Schema::create('pc_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pc::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SystemUnit::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Monitor::class)->constrained()->cascadeOnDelete();
            $table->string('assigned_at');
            $table->string('unassigned_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pc_assignments');
    }
};
