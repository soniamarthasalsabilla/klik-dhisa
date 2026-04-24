<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batas_dusun', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dusun');
            $table->string('warna')->default('#3A9A8C');
            $table->json('koordinat');   // array of [lat, lng] pairs (polygon)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batas_dusun');
    }
};
