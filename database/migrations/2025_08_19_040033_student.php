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
        Schema::create('student', function (Blueprint $table) {
            $table->bigIncrements('studentid');
            $table->unsignedBigInteger('schoolyearid');
            $table->foreign('schoolyearid')->references('schoolyearid')->on('schoolyear')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('place', 50);
            $table->date('birthdate');
            $table->enum('sex', ['Laki-laki', 'Perempuan']);
            $table->enum('status', ['prostudent', 'student', 'graduated']);
            $table->date('datejoin');
            $table->double('studentfeeamount');
            $table->string('contract', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
