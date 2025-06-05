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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_address');
            $table->string('patient_email');
            $table->foreignId('visit_type');
            $table->foreignId('doctor_id');
            $table->foreignId('treatment_type')->nullable();
            $table->string('medication')->nullable();
            $table->integer('cost')->default('0');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
