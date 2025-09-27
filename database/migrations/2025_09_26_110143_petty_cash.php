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
        Schema::create('petty_cash', function (Blueprint $table) {
            $table->bigIncrements('petty_cash_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->longText('description');
            $table->enum('type_in_out', ['income', 'expense']);
            $table->decimal('amount', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_cash');
    }
};
