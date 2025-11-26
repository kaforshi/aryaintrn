<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::getActive();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'avatar' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'typewriter_words' => 'nullable|string',
            'verified' => 'boolean',
            'status_online' => 'boolean',
            'footer_text' => 'nullable|string|max:255',
        ]);

        $profile = Profile::getActive();
        
        $data = $request->all();
        
        // Convert typewriter_words string to array
        if ($request->has('typewriter_words') && $request->typewriter_words) {
            $data['typewriter_words'] = array_map('trim', explode(',', $request->typewriter_words));
        }

        $profile->update($data);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile berhasil diperbarui!');
    }
}
