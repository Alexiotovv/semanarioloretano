<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\News;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{


    public function index()
    {
        $news = News::orderBy('published_at', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function publicIndex()
    {
        $news = News::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('news.public-index', compact('news'));
    }

    public function create(Request $request)
    {
        return view('news.create', [
            'sections' => Section::query()->orderBy('title')->get(),
            'selectedSectionId' => $request->integer('section_id') ?: null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'section_id' => 'nullable|exists:sections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $data['published_at'] = now();
        News::create($data);

        return redirect()->route('news.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function show(News $news)
    {
        $sections = Section::with(['news' => fn ($query) => $query->whereNotNull('published_at')
                ->latest('published_at')
                ->limit(3)])
            ->orderBy('title')
            ->get();

        $latestNews = News::whereNotNull('published_at')
            ->where('id', '!=', $news->id)
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        $sidebarAds = Advertisement::where('position', 'sidebar')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('news.show', compact('news', 'sections', 'latestNews', 'sidebarAds'));
    }

    public function edit(News $news)
    {
        return view('news.edit', [
            'news' => $news,
            'sections' => Section::query()->orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'section_id' => 'nullable|exists:sections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Noticia actualizada exitosamente.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Noticia eliminada exitosamente.');
    }
}