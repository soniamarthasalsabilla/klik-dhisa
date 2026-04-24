<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('browser', 100)->nullable();
            $table->string('os', 100)->nullable();
            $table->string('device', 50)->default('Desktop');
            $table->string('page_url', 500);
            $table->string('route_name', 100)->nullable();
            $table->string('referer', 500)->nullable();
            $table->string('session_id', 100)->nullable();
            $table->timestamp('visited_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
