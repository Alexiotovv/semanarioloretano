<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function index(): View
    {
        return view('sections.index', [
            'sections' => Section::query()->orderBy('title')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('sections.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Section::create($this->validatedData($request));

        return redirect()->route('sections.index')->with('success', 'Sección creada correctamente.');
    }

    public function show(Section $section): View
    {
        return view('sections.show', compact('section'));
    }

    public function news(Section $section): View
    {
        return view('sections.news', [
            'section' => $section,
            'news' => $section->news()->latest('published_at')->paginate(10),
        ]);
    }

    public function edit(Section $section): View
    {
        return view('sections.edit', compact('section'));
    }

    public function update(Request $request, Section $section): RedirectResponse
    {
        $section->update($this->validatedData($request, $section));

        return redirect()->route('sections.index')->with('success', 'Sección actualizada correctamente.');
    }

    public function destroy(Section $section): RedirectResponse
    {
        $section->delete();

        return redirect()->route('sections.index')->with('success', 'Sección eliminada correctamente.');
    }

    private function validatedData(Request $request, ?Section $section = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('sections', 'title')->ignore($section)],
            'show_in_nav' => ['boolean'],
        ]);

        $data['show_in_nav'] = $request->boolean('show_in_nav');

        return $data;
    }
}