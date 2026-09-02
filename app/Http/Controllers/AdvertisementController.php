<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{

    public function index()
    {
        $advertisements = Advertisement::orderBy('order')->paginate(10);
        return view('advertisements.index', compact('advertisements'));
    }

    public function create()
    {
        return view('advertisements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'position' => 'required|in:sidebar,banner,footer',
            'is_active' => 'boolean',
            'order' => 'integer|default:0',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('advertisements', 'public');
            $data['image'] = $imagePath;
        }

        $data['is_active'] = $request->has('is_active');
        Advertisement::create($data);

        return redirect()->route('advertisements.index')->with('success', 'Publicidad creada exitosamente.');
    }

    public function edit(Advertisement $advertisement)
    {
        return view('advertisements.edit', compact('advertisement'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'position' => 'required|in:sidebar,banner,footer',
            'is_active' => 'boolean',
            'order' => 'integer|default:0',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }
            $imagePath = $request->file('image')->store('advertisements', 'public');
            $data['image'] = $imagePath;
        }

        $data['is_active'] = $request->has('is_active');
        $advertisement->update($data);

        return redirect()->route('advertisements.index')->with('success', 'Publicidad actualizada exitosamente.');
    }

    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->image) {
            Storage::disk('public')->delete($advertisement->image);
        }
        $advertisement->delete();

        return redirect()->route('advertisements.index')->with('success', 'Publicidad eliminada exitosamente.');
    }
}