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
        Schema::create('studentbill', function (Blueprint $table) {
            $table->bigIncrements('studentbillid');
            $table->unsignedBigInteger('categoryid');
            $table->foreign('categoryid')->references('categoryid')->on('category')->cascadeOnDelete();
            $table->unsignedBigInteger('accountsource');
            $table->index('accountsource');
            $table->string('billname', 100);
            $table->double('billamount');
            $table->date('duedate');
            $table->enum('billstatus', ['paid', 'credit', 'unpaid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentbill');
    }
};
