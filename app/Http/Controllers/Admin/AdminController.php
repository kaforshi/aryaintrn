<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\WorkExperience;
use App\Models\Project;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Simple authentication - in production, use proper user authentication
        // For now, we'll use environment variables
        $adminEmail = env('ADMIN_EMAIL', 'admin@portfolio.com');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }

    public function dashboard()
    {
        $profile = Profile::getActive();
        $stats = [
            'skills' => Skill::count(),
            'work_experiences' => WorkExperience::count(),
            'projects' => Project::count(),
            'social_links' => SocialLink::count(),
        ];

        return view('admin.dashboard', compact('profile', 'stats'));
    }
}
