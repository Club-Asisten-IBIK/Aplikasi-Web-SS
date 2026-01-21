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
        Schema::create('rolepreviledge', function (Blueprint $table) {
            $table->bigIncrements('rolepreviledgeid');
            $table->unsignedBigInteger('roleid')->nullable();
            $table->foreign('roleid')->references('roleid')->on('role')->onDelete('cascade')->nullable();
            $table->boolean('read')->nullable();
            $table->boolean('create')->nullable();
            $table->boolean('modify')->nullable();
            $table->boolean('delete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolepreviledge');
    }
};
