<?php

use Brick\Math\BigInteger;
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
        Schema::create('studentpayment', function (Blueprint $table) {
            $table->bigIncrements('studentpaymentid', 20);
            $table->unsignedBigInteger('studentbillid');
            $table->foreign('studentbillid')
                ->references('studentbillid')->on('studentbill')
                ->cascadeOnDelete();
            $table->double('amount');
            $table->date('paymentdate');
            $table->string('receipt', 50);
            $table->enum('paymentmethod', ['cash', 'transfer', 'qris']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentpayment');
    }
};
