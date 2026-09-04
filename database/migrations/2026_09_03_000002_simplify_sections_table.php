<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['summary', 'content', 'image', 'category', 'is_featured', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
        });
    }
};