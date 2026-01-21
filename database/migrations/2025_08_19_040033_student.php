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
            $table->id();

            // Relasi
            $table->foreignId('sekolah_id')->constrained('sekolah')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();

            // Identitas siswa
            $table->string('nomor_induk', 50)->unique();
            $table->string('nama_lengkap', 50);
            $table->string('nama_panggilan', 50)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 40);
            $table->date('tanggal_lahir');

            // Data keluarga & sosial
            $table->enum('wilayah', ['Dalam Kota', 'Luar Kota'])->nullable();
            $table->enum('kewarganegaraan', ['WNI', 'WNA'])->default('WNI');
            $table->tinyInteger('jumlah_saudara_kandung')->default(0);
            $table->tinyInteger('jumlah_saudara_tiri')->default(0);
            $table->tinyInteger('jumlah_saudara_angkat')->default(0);

            // Domisili
            $table->string('bahasa_rumah', 100)->nullable();
            $table->text('alamat');
            $table->enum('status_tempat_tinggal', ['Orang Tua', 'Wali', 'Asrama', 'Kost'])->nullable();
            $table->decimal('jarak_km', 5, 2)->nullable();

            // Kontak & foto
            $table->string('telepon', 16)->nullable();
            $table->string('foto', 255)->nullable(); // pas foto

            // Status akademik
            $table->enum('status_siswa', ['Calon', 'Aktif', 'Lulus'])->default('Calon');
            $table->date('tanggal_masuk');
            $table->double('biaya_pendidikan')->nullable();
            $table->text('catatan')->nullable();

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
