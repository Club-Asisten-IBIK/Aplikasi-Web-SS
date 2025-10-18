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
        Schema::create('student_guardians', function (Blueprint $table) {
            $table->bigIncrements('student_guardianid');
            $table->unsignedBigInteger('studentid');
            $table->foreign('studentid')->references('studentid')->on('student')->onDelete('cascade');
            $table->string('name', 100);
            $table->enum('family_relation', ['father', 'mother', 'guardian']);
            $table->enum('education', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'none']);
            $table->string('occupation', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_guardians');
    }
};
