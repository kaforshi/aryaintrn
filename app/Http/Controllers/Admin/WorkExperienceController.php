<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkExperience;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    public function index()
    {
        $workExperiences = WorkExperience::orderBy('order')->get();
        return view('admin.work-experiences.index', compact('workExperiences'));
    }

    public function create()
    {
        return view('admin.work-experiences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_present' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        WorkExperience::create($request->all());

        return redirect()->route('admin.work-experiences.index')->with('success', 'Work Experience berhasil ditambahkan!');
    }

    public function edit(WorkExperience $workExperience)
    {
        return view('admin.work-experiences.edit', compact('workExperience'));
    }

    public function update(Request $request, WorkExperience $workExperience)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_present' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $workExperience->update($request->all());

        return redirect()->route('admin.work-experiences.index')->with('success', 'Work Experience berhasil diperbarui!');
    }

    public function destroy(WorkExperience $workExperience)
    {
        $workExperience->delete();
        return redirect()->route('admin.work-experiences.index')->with('success', 'Work Experience berhasil dihapus!');
    }
}
