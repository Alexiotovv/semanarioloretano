<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    public function edit()
    {
        $header = Header::first() ?? new Header();
        return view('design.edit', compact('header'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'login_title' => 'nullable|string|max:255',
            'login_subtitle' => 'nullable|string|max:255',
            'login_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'navbar_bg_color' => 'nullable|string|max:20',
            'footer_bg_color' => 'nullable|string|max:20',
            'header_font_family' => 'nullable|string|max:100',
            'header_title_font_size' => 'nullable|integer|min:14|max:80',
            'header_text_color' => 'nullable|string|max:20',
        ]);

        $header = Header::first() ?? new Header();
        $data = $request->except('login_logo');

        if ($request->hasFile('login_logo')) {
            if ($header->login_logo) {
                Storage::disk('public')->delete($header->login_logo);
            }
            $data['login_logo'] = $request->file('login_logo')->store('design', 'public');
        }

        $header->fill($data);
        $header->save();

        return redirect()->route('design.edit')->with('success', 'Diseño actualizado exitosamente.');
    }
}
