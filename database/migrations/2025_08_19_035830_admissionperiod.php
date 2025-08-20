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
            $table->unsignedBigInteger('schoolyearid');
            $table->foreign('schoolyearid')->references('schoolyearid')->on('schoolyear')->onDelete('cascade');
            $table->string('periodname', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active');
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
