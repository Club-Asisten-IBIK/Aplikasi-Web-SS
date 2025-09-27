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
        Schema::create('grant_allocations', function (Blueprint $table) {
            $table->bigIncrements('grant_allocation_id');
            $table->unsignedBigInteger('grantid');
            $table->unsignedBigInteger('budget_detail_id');
            $table->unsignedBigInteger('categoryid');
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grant_allocations');
    }
};
