<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{


    public function edit()
    {
        $header = Header::first() ?? new Header();
        return view('header.edit', compact('header'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'navbar_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $header = Header::first() ?? new Header();
        $data = $request->all();
        
        if ($request->hasFile('image')) {
            if ($header->image) {
                Storage::disk('public')->delete($header->image);
            }
            $imagePath = $request->file('image')->store('headers', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('navbar_logo')) {
            if ($header->navbar_logo) {
                Storage::disk('public')->delete($header->navbar_logo);
            }
            $data['navbar_logo'] = $request->file('navbar_logo')->store('headers', 'public');
        }

        $header->fill($data);
        $header->save();

        return redirect()->route('header.edit')->with('success', 'Encabezado actualizado exitosamente.');
    }
}