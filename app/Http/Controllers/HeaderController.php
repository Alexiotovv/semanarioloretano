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
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'navbar_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'navbar_logo_height' => 'nullable|integer|min:20|max:300',
        ]);

        $header = Header::first() ?? new Header();
        $data = $request->all();

        foreach (['image', 'image_2', 'image_3', 'navbar_logo'] as $field) {
            if ($request->hasFile($field)) {
                if ($header->$field) {
                    Storage::disk('public')->delete($header->$field);
                }
                $data[$field] = $request->file($field)->store('headers', 'public');
            }
        }

        $header->fill($data);
        $header->save();

        return redirect()->route('header.edit')->with('success', 'Encabezado actualizado exitosamente.');
    }
}