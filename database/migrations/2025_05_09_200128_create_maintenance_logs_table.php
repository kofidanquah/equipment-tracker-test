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
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('equipment_id');
            $table->foreign('equipment_id')->references('id')->on('equipments')->cascadeOnDelete();
            $table->foreignId('assigned_to');
            $table->foreign('assigned_to')->references('id')->on('users')->cascadeOnDelete();
            $table->date('maintenance_date');
            $table->date('next_maintenance')->nullable();
            $table->string('notes')->nullable();
            $table->enum('status', [0,1,2])->default(0)->comment('0 = pending, 1 = completed, 2 = escalated');
            $table->string('remarks')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
