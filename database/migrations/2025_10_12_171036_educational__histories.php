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
        Schema::create('educational__histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('student')->cascadeOnDelete();

            $table->enum('jenis_masuk', ['Baru', 'Pindahan']);
            $table->string('nama_instansi', 100);
            $table->text('alamat_instansi')->nullable();
            $table->string('usia_saat_masuk', 50)->nullable();
            $table->date('tanggal_diterima')->nullable();
            $table->string('kelompok_usia', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational__histories');
    }
};
