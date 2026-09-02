<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Advertisement;
use App\Models\Header;

class HomeController extends Controller
{
    public function index()
    {
        $header = Header::first();
        $featuredNews = News::where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        $latestNews = News::orderBy('published_at', 'desc')
            ->limit(5)
            ->get();
        $sidebarAds = Advertisement::where('position', 'sidebar')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        $bannerAds = Advertisement::where('position', 'banner')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('home.index', compact(
            'header', 
            'featuredNews', 
            'latestNews', 
            'sidebarAds', 
            'bannerAds'
        ));
    }
}