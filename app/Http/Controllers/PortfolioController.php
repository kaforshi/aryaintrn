<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\WorkExperience;
use App\Models\Project;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::getActive();
        
        // Increment views
        $profile->increment('views');
        
        $skills = Skill::orderBy('order')->get();
        $workExperiences = WorkExperience::orderBy('order')->get();
        $projects = Project::orderBy('order')->get();
        $socialLinks = SocialLink::orderBy('order')->get();
        
        return view('portfolio.index', compact('profile', 'skills', 'workExperiences', 'projects', 'socialLinks'));
    }
}
