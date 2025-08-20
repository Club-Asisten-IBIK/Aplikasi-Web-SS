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
        Schema::create('revenue', function (Blueprint $table) {
            $table->bigIncrements('revenueid');
            $table->string('accountcode', 20);
            $table->foreign('accountcode')->references('accountcode')->on('account')->cascadeOnDelete();
            $table->unsignedBigInteger('categoryid');
            $table->foreign('categoryid')->references('categoryid')->on('category')->cascadeOnDelete();
            $table->unsignedBigInteger('accountsource')->nullable();
            $table->index('accountsource');
            $table->string('revenuename', 100);
            $table->double('revenueamount');
            $table->date('revenue_date');
            $table->string('revenuedescription', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue');
    }
};
