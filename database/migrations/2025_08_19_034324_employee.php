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
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('employeeid');
            $table->string('nip', 12)->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('nama_lengkap', 100)->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('gelar_depan', 20)->nullable();
            $table->string('gelar_belakang', 20)->nullable();
            $table->enum('pendidikan', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('kontak', 16)->nullable();
            $table->string('email', 16)->nullable();
            $table->text('alamat')->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'budha', 'konghucu', 'lainnya'])->nullable();
            $table->enum('status_perkawinan', ['belum kawin', 'kawin', 'cerai hidup', 'cerai mati'])->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
