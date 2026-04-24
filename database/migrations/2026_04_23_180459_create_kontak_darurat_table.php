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
        Schema::create('kontak_darurat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor');
            $table->string('icon')->default('fa-phone-alt');
            $table->string('warna_bg')->default('#E8F5F0');
            $table->string('warna_teks')->default('#1E5A52');
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Default 4 kontak
        DB::table('kontak_darurat')->insert([
            ['nama'=>'Ambulans',           'nomor'=>'118', 'icon'=>'fa-ambulance',  'warna_bg'=>'#fce4e4','warna_teks'=>'#dc3545','urutan'=>1,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Polisi',             'nomor'=>'110', 'icon'=>'fa-shield-alt', 'warna_bg'=>'#cfe2ff','warna_teks'=>'#0d6efd','urutan'=>2,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Pemadam Kebakaran',  'nomor'=>'113', 'icon'=>'fa-fire',       'warna_bg'=>'#fff3cd','warna_teks'=>'#856404','urutan'=>3,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
            ['nama'=>'Hotline Desa',       'nomor'=>'-',   'icon'=>'fa-home',       'warna_bg'=>'#E8F5F0','warna_teks'=>'#1E5A52','urutan'=>4,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_darurat');
    }
};
