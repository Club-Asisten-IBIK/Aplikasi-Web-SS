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
        Schema::create('employee_attendance', function (Blueprint $table) {
            $table->bigIncrements('employee_attendanceid');
            $table->unsignedBigInteger('employee_id');
            $table->enum('status', ['present', 'absent', 'leave', 'sick']);
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attendance');
    }
};
