<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis'); // Tanah, Bangunan, Kendaraan, Peralatan & Mesin, Infrastruktur, Aset Tetap Lainnya
            $table->string('kondisi')->default('Baik'); // Baik, Rusak Ringan, Rusak Sedang, Rusak Berat
            $table->string('lokasi')->nullable();
            $table->decimal('luas', 12, 2)->nullable();
            $table->smallInteger('tahun_perolehan')->nullable();
            $table->bigInteger('nilai_perolehan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_desas');
    }
};
