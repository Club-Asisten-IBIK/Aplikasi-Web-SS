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
        Schema::create('studentfee', function (Blueprint $table) {
            $table->bigIncrements('studentfeeid', 20);
            $table->unsignedBigInteger('studentid');
            $table->foreign('studentid')
                ->references('studentid')->on('student')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('schoolyearid');
            $table->foreign('schoolyearid')
                ->references('schoolyearid')->on('schoolyear')
                ->cascadeOnDelete();
            $table->string('accountcode', 20);
            $table->foreign('accountcode')
                ->references('accountcode')->on('account')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('categoryid');
            $table->foreign('categoryid')
                ->references('categoryid')->on('category')
                ->cascadeOnDelete();
            $table->string('notanumber', 50);
            $table->enum('month', ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
            $table->date('studentfeedate');
            $table->double('studentfeeamount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentfee');
    }
};
