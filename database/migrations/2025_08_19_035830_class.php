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
            $table->unsignedBigInteger('guardianid');
            $table->string('classname', 100);
            $table->enum('gradelevel', ['TK-A', 'TK-B', '1', '2', '3', '4', '5', '6', '7', '8']);
            $table->integer('capacity');
            $table->boolean('isactive')->default(true);
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
