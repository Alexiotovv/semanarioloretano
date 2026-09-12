<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact()
    {
        $header = Header::first();
        return view('pages.contact', compact('header'));
    }

    public function about()
    {
        $header = Header::first();
        return view('pages.about', compact('header'));
    }

    public function edit()
    {
        $header = Header::first() ?? new Header();
        return view('pages.edit', compact('header'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'about_text' => 'nullable|string',
        ]);

        $header = Header::first() ?? new Header();
        $header->fill($request->only(['contact_phone', 'contact_email', 'about_text']));
        $header->save();

        return redirect()->route('pages.edit')->with('success', 'Información actualizada exitosamente.');
    }
}
