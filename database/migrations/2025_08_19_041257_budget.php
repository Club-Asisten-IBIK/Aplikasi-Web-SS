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
        Schema::create('budget', function (Blueprint $table) {
            $table->bigIncrements('budgetid', 20);
            $table->string('accountcode', 20);
            $table->foreign('accountcode')->references('accountcode')->on('account')->onDelete('cascade');
            $table->double('totalbudget');
            $table->date('proposedate');
            $table->date('approvaldate');
            $table->enum('paymentsatus', ['paid', 'credit', 'unpaid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget');
    }
};
