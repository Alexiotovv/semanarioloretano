<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Advertisement;
use App\Models\Header;
use App\Models\Section;

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
        $sections = Section::with(['news' => fn ($query) => $query->whereNotNull('published_at')
                ->latest('published_at')
                ->limit(3)])
            ->orderBy('title')
            ->get();

        return view('home.index', compact(
            'header', 
            'featuredNews', 
            'latestNews', 
            'sidebarAds', 
            'bannerAds',
            'sections'
        ));
    }
}