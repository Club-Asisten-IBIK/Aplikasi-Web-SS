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
        Schema::create('reportcarditem', function (Blueprint $table) {
            $table->bigIncrements('reportcarditemid');
            $table->unsignedBigInteger('reportcard_id');
            $table->unsignedBigInteger('subject_id');
            $table->decimal('finalscore', 5, 2);
            $table->string('teachercomment', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportcarditem');
    }
};
