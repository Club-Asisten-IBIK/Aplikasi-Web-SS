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
        Schema::create('payslip', function (Blueprint $table) {
            $table->bigIncrements('payslipid', 20);
            $table->unsignedBigInteger('employeeid');
            $table->foreign('employeeid')
                ->references('employeeid')->on('employee')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('schoolyearid');
            $table->foreign('schoolyearid')
                ->references('schoolyearid')->on('schoolyear')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('categoryid');
            $table->foreign('categoryid')
                ->references('categoryid')->on('category')
                ->cascadeOnDelete();
            $table->string('accountcode', 20);
            $table->foreign('accountcode')->references('accountcode')->on('account')->cascadeOnDelete();
            $table->enum('month', ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslip');
    }
};
