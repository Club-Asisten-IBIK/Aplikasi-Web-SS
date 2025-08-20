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
            $table->unsignedBigInteger('roleid');
            $table->foreign('roleid')->references('roleid')->on('role')->onDelete('cascade');
            $table->boolean('read');
            $table->boolean('create');
            $table->boolean('modify');
            $table->boolean('delete');
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
