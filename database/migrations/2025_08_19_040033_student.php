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
        Schema::create('student', function (Blueprint $table) {
            $table->bigIncrements('studentid');
            $table->unsignedBigInteger('schoolyearid');
            $table->foreign('schoolyearid')->references('schoolyearid')->on('schoolyear')->onDelete('cascade');
            $table->unsignedBigInteger('classid');
            $table->foreign('classid')->references('classid')->on('class')->onDelete('cascade');
            $table->string('student_number', 20)->unique();
            $table->string('fullname', 50);
            $table->string('nickname', 50);
            $table->string('birthplace', 50);
            $table->date('birthdate');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->enum('religion', ['Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('nationality', ['WNI', 'WNA']);
            $table->tinyInteger('siblings_full')->nullable();
            $table->tinyInteger('siblings_step')->nullable();
            $table->tinyInteger('siblings_adopted')->nullable();
            $table->string('home_language', 100)->nullable();
            $table->text('address');
            $table->enum('living_with', ['Orang Tua', 'Wali', 'Keluarga Lain'])->nullable();
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['prostudent', 'student', 'graduated']);
            $table->date('datejoin');
            $table->double('studentfeeamount');
            $table->string('contract', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
