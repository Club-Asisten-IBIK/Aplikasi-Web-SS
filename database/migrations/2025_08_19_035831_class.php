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
        Schema::create('class', function (Blueprint $table) {
            $table->bigIncrements('classid');
            $table->unsignedBigInteger('teacherid')->nullable();
            $table->string('classname', 100)->nullable();
            $table->enum('gradelevel', ['TK-A', 'TK-B', '1', '2', '3', '4', '5', '6', '7', '8'])->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('isactive')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
