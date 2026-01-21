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
        Schema::create('admissionperiod', function (Blueprint $table) {
            $table->bigIncrements('admissionperiodid');
            $table->unsignedBigInteger('schoolyearid')->nullable();
            $table->foreign('schoolyearid')->references('schoolyearid')->on('schoolyear')->onDelete('cascade')->nullable();
            $table->string('periodname', 50)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissionperiod');
    }
};
