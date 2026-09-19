<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'image', 'image_2', 'image_3',
        'navbar_logo', 'navbar_logo_height', 'contact_phone', 'contact_email', 'about_text',
        'login_title', 'login_subtitle', 'login_logo',
        'navbar_bg_color', 'footer_bg_color',
        'header_font_family', 'header_title_font_size', 'header_text_color',
    ];
}