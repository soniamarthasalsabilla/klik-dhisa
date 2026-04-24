<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            // Ubah dari ENUM ke VARCHAR agar fleksibel saat import CSV
            $table->string('kategori', 100)->change();
            // Jadikan no_hp nullable agar aman jika kosong di CSV
            $table->string('no_hp')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->enum('kategori', ['Makanan', 'Kerajinan', 'Jasa', 'Pertanian'])->change();
            $table->string('no_hp')->nullable(false)->change();
        });
    }
};
