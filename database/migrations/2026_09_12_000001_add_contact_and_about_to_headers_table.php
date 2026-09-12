<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('headers', function (Blueprint $table) {
            $table->string('contact_phone')->nullable()->after('description');
            $table->string('contact_email')->nullable()->after('contact_phone');
            $table->longText('about_text')->nullable()->after('contact_email');
        });
    }

    public function down(): void
    {
        Schema::table('headers', function (Blueprint $table) {
            $table->dropColumn(['contact_phone', 'contact_email', 'about_text']);
        });
    }
};
