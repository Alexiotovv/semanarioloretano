<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('headers', function (Blueprint $table) {
            $table->string('login_title')->nullable()->after('about_text');
            $table->string('login_subtitle')->nullable()->after('login_title');
            $table->string('login_logo')->nullable()->after('login_subtitle');
            $table->string('navbar_bg_color')->nullable()->after('login_logo');
            $table->string('footer_bg_color')->nullable()->after('navbar_bg_color');
            $table->string('header_font_family')->nullable()->after('footer_bg_color');
            $table->unsignedInteger('header_title_font_size')->nullable()->after('header_font_family');
            $table->string('header_text_color')->nullable()->after('header_title_font_size');
        });
    }

    public function down(): void
    {
        Schema::table('headers', function (Blueprint $table) {
            $table->dropColumn([
                'login_title',
                'login_subtitle',
                'login_logo',
                'navbar_bg_color',
                'footer_bg_color',
                'header_font_family',
                'header_title_font_size',
                'header_text_color',
            ]);
        });
    }
};
