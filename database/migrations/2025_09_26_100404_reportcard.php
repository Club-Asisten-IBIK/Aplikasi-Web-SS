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
        Schema::create('reportcard', function (Blueprint $table) {
            $table->bigIncrements('reportcardid');
            $table->unsignedBigInteger('student_id');
            $table->enum('term', ['Ganjil', 'Genap']);
            $table->date('issudate');
            $table->string('remarks', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportcard');
    }
};
