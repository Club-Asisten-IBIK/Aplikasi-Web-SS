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
        Schema::create('educational__histories', function (Blueprint $table) {
            $table->bigIncrements('educational_historyid');
            $table->unsignedBigInteger('studentid');
            $table->foreign('studentid')->references('studentid')->on('student')->onDelete('cascade');
            $table->string('institution_name', 100);
            $table->text('institution_address');
            $table->string('from_age_group', 50);
            $table->date('admitted_date');
            $table->string('admitted_age_group', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational__histories');
    }
};
