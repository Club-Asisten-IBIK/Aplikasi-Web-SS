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
        Schema::create('grant_reports', function (Blueprint $table) {
            $table->bigIncrements('grant_report_id');
            $table->unsignedBigInteger('grantid');
            $table->string('period_start');
            $table->string('period_end');
            $table->text('file_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grant_reports');
    }
};
