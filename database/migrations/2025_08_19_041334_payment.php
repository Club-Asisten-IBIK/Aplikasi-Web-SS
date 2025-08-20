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
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('paymentid', 20);
            $table->foreignId('budgetid')
                ->constrained('budget', 'budgetid')
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
        Schema::dropIfExists('payment');
    }
};
