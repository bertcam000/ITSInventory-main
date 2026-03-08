<?php

use App\Models\Department;
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
            $table->string('asset_tag')->index();
            $table->foreignId('department_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('system_unit_id')
                ->constrained('assets')
                ->cascadeOnDelete();

            $table->foreignId('monitor_id')
                ->constrained('assets')
                ->cascadeOnDelete();

            
            $table->string('assigned_to');
            $table->string('status')->default('assigned');

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();
            
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
