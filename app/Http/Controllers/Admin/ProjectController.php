<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'tags' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        
        // Convert tags string to array
        if ($request->has('tags') && $request->tags) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:500',
            'github_url' => 'nullable|url|max:500',
            'tags' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        
        // Convert tags string to array
        if ($request->has('tags') && $request->tags) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus!');
    }
}
