<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('url', 2048);
            $table->text('referrer')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device_type', 20);
            $table->string('session_id')->nullable();
            $table->timestamp('visited_at')->useCurrent();

            $table->index('visited_at');
            $table->index('session_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};