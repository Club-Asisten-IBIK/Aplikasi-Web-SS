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
        Schema::create('budgetdetail', function (Blueprint $table) {
            $table->bigIncrements('budgetdetailid', 20);
            $table->foreignId('categoryid')->constrained('category', 'categoryid')->cascadeOnDelete();
            $table->foreignId('supplierid')->constrained('supplier', 'supplierid')->cascadeOnDelete();
            $table->foreignId('budgetid')->constrained('budget', 'budgetid')->cascadeOnDelete();
            $table->string('budgetname', 50);
            $table->double('amount');
            $table->enum('type', ['income', 'expense']);
            $table->date('purchasedate');
            $table->integer('qty')->default(1);
            $table->string('pcs', 10);
            $table->string('description', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgetdetail');
    }
};
