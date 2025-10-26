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
        Schema::create('userrole', function (Blueprint $table) {
            $table->bigIncrements('userroleid');
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('roleid')->nullable();
            $table->unsignedBigInteger('employeeid')->nullable();
            $table->unsignedBigInteger('parentid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userrole');
    }
};
