<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\WorkExperience;
use App\Models\Project;
use App\Models\SocialLink;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Profile
        Profile::create([
            'name' => 'Rae',
            'username' => 'sleepyrae',
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200&q=80',
            'description' => 'Just a sleepy developer making things on the web. Into anime, coffee, and dark mode.',
            'typewriter_words' => ['Web Developer', 'Sleepy', 'UI/UX Designer', 'Gamer'],
            'email' => 'contact@sleepyrae.dev',
            'views' => 12500,
            'verified' => true,
            'status_online' => true,
            'footer_text' => '© 2024 hypeproject.dev style clone',
        ]);

        // Skills
        $skills = [
            ['name' => 'HTML5', 'icon_class' => 'fab fa-html5', 'color_class' => 'text-orange-500', 'order' => 1],
            ['name' => 'CSS3', 'icon_class' => 'fab fa-css3-alt', 'color_class' => 'text-blue-500', 'order' => 2],
            ['name' => 'JavaScript', 'icon_class' => 'fab fa-js', 'color_class' => 'text-yellow-400', 'order' => 3],
            ['name' => 'React', 'icon_class' => 'fab fa-react', 'color_class' => 'text-cyan-400', 'order' => 4],
            ['name' => 'Tailwind', 'icon_class' => 'fas fa-wind', 'color_class' => 'text-teal-400', 'order' => 5],
            ['name' => 'NodeJS', 'icon_class' => 'fab fa-node', 'color_class' => 'text-green-500', 'order' => 6],
            ['name' => 'Figma', 'icon_class' => 'fab fa-figma', 'color_class' => 'text-pink-400', 'order' => 7],
            ['name' => 'Git', 'icon_class' => 'fab fa-git-alt', 'color_class' => 'text-red-500', 'order' => 8],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Work Experiences
        WorkExperience::create([
            'title' => 'Senior Frontend Dev',
            'company' => 'Tech Startup Inc.',
            'description' => 'Building scalable web apps using React & Tailwind.',
            'start_date' => '2023-01-01',
            'is_present' => true,
            'order' => 1,
        ]);

        WorkExperience::create([
            'title' => 'UI/UX Designer',
            'company' => 'Freelance Studio',
            'start_date' => '2021-01-01',
            'end_date' => '2023-12-31',
            'is_present' => false,
            'order' => 2,
        ]);

        // Projects
        Project::create([
            'title' => 'HypeBio Clone',
            'description' => 'A responsive bio link template with glassmorphism effects and dark mode aesthetics.',
            'url' => '#',
            'tags' => ['HTML', 'Tailwind'],
            'order' => 1,
        ]);

        Project::create([
            'title' => 'Spotify Widget',
            'description' => 'Real-time Spotify playing widget using API integration for personal portfolio.',
            'url' => '#',
            'github_url' => '#',
            'tags' => ['JavaScript', 'API'],
            'order' => 2,
        ]);

        // Social Links
        SocialLink::create([
            'name' => 'Email',
            'icon_class' => 'fas fa-envelope',
            'url' => 'contact@sleepyrae.dev',
            'color_class' => 'bg-red-500/20',
            'type' => 'email',
            'order' => 1,
        ]);

        SocialLink::create([
            'name' => 'Instagram',
            'icon_class' => 'fab fa-instagram',
            'url' => '#',
            'color_class' => 'bg-pink-500/20',
            'type' => 'link',
            'order' => 2,
        ]);

        SocialLink::create([
            'name' => 'GitHub',
            'icon_class' => 'fab fa-github',
            'url' => '#',
            'color_class' => 'bg-white/10',
            'type' => 'link',
            'order' => 3,
        ]);

        SocialLink::create([
            'name' => 'WhatsApp',
            'icon_class' => 'fab fa-whatsapp',
            'url' => 'https://wa.me/628123456789',
            'color_class' => 'bg-green-500/20',
            'type' => 'whatsapp',
            'order' => 4,
        ]);
    }
}
