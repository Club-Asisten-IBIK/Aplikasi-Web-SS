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
        Schema::create('salary', function (Blueprint $table) {
            $table->bigIncrements('salaryid');

            $table->unsignedBigInteger('employeeid');
            $table->unsignedBigInteger('componentid');

            $table->double('amount');

            // Unik supaya tiap komponen untuk karyawan tidak dobel
            $table->unique(['employeeid', 'componentid']);

            $table->foreign('employeeid')
                ->references('employeeid')->on('employee')
                ->cascadeOnDelete();

            $table->foreign('componentid')
                ->references('componentid')->on('componentsalary')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary');
    }
};
