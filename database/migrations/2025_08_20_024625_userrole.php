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
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('roleid');
            $table->unsignedBigInteger('employeeid');
            $table->unsignedBigInteger('parentid');
            $table->primary(['userid', 'roleid']);
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
