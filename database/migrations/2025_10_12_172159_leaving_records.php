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
        Schema::create('leaving_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('student')->cascadeOnDelete();

            $table->string('jenis_keluar', 10);
            $table->string('nomor_surat', 100)->nullable();
            $table->string('melanjutkan_ke', 150)->nullable();
            $table->string('asal_kelompok', 50)->nullable();
            $table->string('tujuan_instansi', 150)->nullable();
            $table->string('kelompok_tujuan', 50)->nullable();
            $table->date('tanggal_pindah')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->text('alasan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaving_records');
    }
};
