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
        Schema::create('physical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('student')->cascadeOnDelete();

            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', 'Tidak Diketahui'])->nullable();
            $table->text('riwayat_penyakit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_records');
    }
};
