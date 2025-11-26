<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('order')->get();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'color_class' => 'nullable|string|max:255',
            'type' => 'required|in:email,link,whatsapp',
            'order' => 'nullable|integer',
        ]);

        SocialLink::create($request->all());

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link berhasil ditambahkan!');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'color_class' => 'nullable|string|max:255',
            'type' => 'required|in:email,link,whatsapp',
            'order' => 'nullable|integer',
        ]);

        $socialLink->update($request->all());

        return redirect()->route('admin.social-links.index')->with('success', 'Social Link berhasil diperbarui!');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')->with('success', 'Social Link berhasil dihapus!');
    }
}
