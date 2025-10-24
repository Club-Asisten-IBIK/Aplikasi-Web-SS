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
        Schema::create('leaving_records', function (Blueprint $table) {
            $table->bigIncrements('leaving_recordid');
            $table->unsignedBigInteger('studentid');
            $table->foreign('studentid')->references('studentid')->on('student')->onDelete('cascade');
            $table->string('entry_type', 10);
            $table->string('letter_type', 100);
            $table->string('continues_to_institution', 150);
            $table->string('from_age_group', 50);
            $table->string('destination_institution', 50);
            $table->string('destination_age_group_level', 50);
            $table->date('transfer_date');
            $table->date('exit_date');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaving_records');
    }
};
