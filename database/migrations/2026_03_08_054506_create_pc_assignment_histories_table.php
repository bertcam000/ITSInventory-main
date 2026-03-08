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
        Schema::create('pc_assignment_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pc_assignment_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

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

            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('unassigned_at')->nullable();

            $table->foreignId('updated_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('action')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pc_assignment_histories');
    }
};
