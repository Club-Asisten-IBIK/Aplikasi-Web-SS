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
        Schema::create('physical_records', function (Blueprint $table) {
            $table->bigIncrements('physical_recordid');
            $table->unsignedBigInteger('studentid');
            $table->foreign('studentid')->references('studentid')->on('student')->onDelete('cascade');
            $table->decimal('height_cm', 5, 2);
            $table->decimal('weight_kg', 5, 2);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->text('medical_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_records');
    }
};
