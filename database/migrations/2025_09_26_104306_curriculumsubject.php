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
        Schema::create('curriculumsubject', function (Blueprint $table) {
            $table->bigIncrements('curriculumsubjectid');
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('subject_id');
            $table->enum('semester', ['1', '2', '3', '4', '5', '6']);
            $table->integer('weekly_hours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculumsubject');
    }
};
