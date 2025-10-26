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
        Schema::create('parents', function (Blueprint $table) {
            $table->bigIncrements('parentid');
            $table->unsignedBigInteger('studentid');
            $table->foreign('studentid')->references('studentid')->on('student')->onDelete('cascade');
            $table->string('name', 50);
            $table->enum('status', ['father', 'mother', 'other']);
            $table->string('contact', 16);
            $table->string('occupation', 50)->nullable();
            $table->enum('education', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3', 'none']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent');
    }
};
