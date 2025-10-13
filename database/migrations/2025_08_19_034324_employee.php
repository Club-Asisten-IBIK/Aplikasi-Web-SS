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
            $table->unsignedBigInteger('roleid');
            $table->string('nip', 12);
            $table->string('fullname', 100);
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->string('fronttitle', 20);
            $table->string('backtitle', 20);
            $table->enum('education', ['SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3']);
            $table->string('contact', 16);
            $table->string('email', 100);
            $table->string('address', 255);
            $table->string('place_of_birth', 50);
            $table->date('birthdate');
            $table->string('photo');
            $table->string('npwp', 50);
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed']);
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
