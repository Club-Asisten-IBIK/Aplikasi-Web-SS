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
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('employeeid', 20);
            $table->string('fullname', 100);
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->string('fronttitile', 20);
            $table->string('backtitle', 20);
            $table->string('contact', 16);
            $table->string('email', 100);
            $table->string('address', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
