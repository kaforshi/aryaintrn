<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name }} - Portfolio</title>
    
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: JetBrains Mono (Khas Developer/Hype) & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="portfolio-page min-h-screen flex items-center justify-center relative selection:bg-accent selection:text-white">

    <!-- Latar Belakang Animasi Partikel -->
    <canvas id="particles-canvas"></canvas>
    
    <!-- Efek Cahaya Tengah -->
    <div class="glow-bg"></div>

    <!-- Container Utama -->
    <main class="w-full max-w-md px-4 py-8 relative z-10">
        
        <!-- Kartu Profil -->
        <div class="bg-card/60 backdrop-blur-xl border border-white/5 rounded-3xl p-6 shadow-2xl overflow-hidden relative group transition-all duration-500 hover:border-white/10">
            
            <!-- Banner / Header Image (Opsional, di sini kita pakai gradient) -->
            <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-purple-900/20 via-blue-900/20 to-purple-900/20 opacity-50"></div>

            <!-- Profile Content -->
            <div class="relative pt-8 flex flex-col items-center text-center">
                
                <!-- Avatar dengan efek putar saat hover -->
                <div class="relative mb-4 group-hover:scale-105 transition-transform duration-500">
                    <div class="w-24 h-24 rounded-full p-1 bg-gradient-to-tr from-accent to-blue-500">
                        <img src="{{ $profile->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&h=200&q=80' }}" 
                             alt="Profile" 
                             class="w-full h-full rounded-full object-cover border-4 border-card">
                    </div>
                    <!-- Status Dot -->
                    @if($profile->status_online)
                    <div class="absolute bottom-1 right-1 w-5 h-5 bg-black rounded-full flex items-center justify-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                    @endif
                </div>

                <!-- Nama & Badge -->
                <h1 class="text-2xl font-bold font-sans tracking-tight text-white flex items-center gap-2">
                    {{ $profile->name }}
                    @if($profile->verified)
                    <i class="fas fa-check-circle text-blue-400 text-sm" title="Verified"></i>
                    @endif
                </h1>
                
                <!-- Username -->
                <p class="text-white/40 font-mono text-sm mt-1">{{ '@' . $profile->username }}</p>

                <!-- Animasi Ketik (Typewriter) -->
                <div class="mt-3 h-6 flex items-center justify-center">
                    <span class="text-sm font-mono text-accent typing-cursor" id="typewriter"></span>
                </div>

                <!-- Deskripsi Pendek -->
                @if($profile->description)
                <p class="text-white/60 text-sm mt-4 leading-relaxed font-sans px-2">
                    {{ $profile->description }}
                </p>
                @endif

                <!-- Informasi Tambahan (Views/Time) -->
                <div class="flex items-center gap-4 mt-6 text-xs text-white/30 font-mono border-t border-white/5 pt-4 w-full justify-center">
                    <div class="flex items-center gap-1.5">
                        <i class="far fa-eye"></i>
                        <span>{{ number_format($profile->views) }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <i class="far fa-clock"></i>
                        <span id="clock">00:00 UTC</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills Section -->
        @if($skills->count() > 0)
        <div class="mt-4 bg-card/60 backdrop-blur-md border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-white/10 transition-all duration-300">
            <!-- Header Section -->
            <h2 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-accent/20 flex items-center justify-center text-accent">
                    <i class="fas fa-terminal text-xs"></i>
                </div>
                <span class="font-sans">Skills</span>
            </h2>

            <!-- Skills List -->
            <div class="flex flex-wrap gap-2">
                @foreach($skills as $skill)
                <div class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/5 hover:border-accent/30 hover:bg-accent/10 transition-colors flex items-center gap-2 group/skill cursor-default">
                    <i class="{{ $skill->icon_class }} {{ $skill->color_class ?? 'text-white' }} group-hover/skill:opacity-80"></i>
                    <span class="text-xs text-white/70 font-mono group-hover/skill:text-white">{{ $skill->name }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Work Experience Section -->
        @if($workExperiences->count() > 0)
        <div class="mt-4 bg-card/60 backdrop-blur-md border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-white/10 transition-all duration-300">
            <!-- Header Section -->
            <h2 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-accent/20 flex items-center justify-center text-accent">
                    <i class="fas fa-briefcase text-xs"></i>
                </div>
                <span class="font-sans">Work Experience</span>
            </h2>

            <!-- Timeline List -->
            <div class="space-y-4 relative">
                <!-- Vertical Line -->
                <div class="absolute left-[11px] top-2 bottom-2 w-[1px] bg-white/10"></div>

                @foreach($workExperiences as $index => $exp)
                <div class="relative pl-8 group/item">
                    <!-- Dot Indicator -->
                    <div class="absolute left-[7px] top-1.5 w-2.5 h-2.5 rounded-full {{ $exp->is_present ? 'bg-accent shadow-[0_0_8px_rgba(168,85,247,0.6)]' : 'bg-neutral-800 border border-white/20 group-hover/item:border-white/50' }} z-10 transition-colors"></div>
                    
                    <div class="flex flex-col">
                        <div class="flex justify-between items-start">
                            <h3 class="text-sm font-bold text-white group-hover/item:text-accent transition-colors duration-300">{{ $exp->title }}</h3>
                            @if($exp->is_present)
                            <span class="text-[10px] text-accent/80 font-mono bg-accent/10 px-2 py-0.5 rounded border border-accent/20">Present</span>
                            @else
                            <span class="text-[10px] text-white/30 font-mono">
                                @if($exp->start_date && $exp->end_date)
                                    {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($exp->end_date)->format('Y') }}
                                @elseif($exp->start_date)
                                    {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }}
                                @endif
                            </span>
                            @endif
                        </div>
                        <p class="text-xs text-white/60 font-medium mt-0.5">{{ $exp->company }}</p>
                        @if($exp->description)
                        <p class="text-[10px] text-white/30 mt-1 leading-relaxed">{{ $exp->description }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- My Projects Section -->
        @if($projects->count() > 0)
        <div class="mt-4 bg-card/60 backdrop-blur-md border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-white/10 transition-all duration-300">
            <!-- Header Section -->
            <h2 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-accent/20 flex items-center justify-center text-accent">
                    <i class="fas fa-code text-xs"></i>
                </div>
                <span class="font-sans">My Projects</span>
            </h2>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 gap-3">
                @foreach($projects as $project)
                <div class="group/project p-3 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-accent/30 transition-all duration-300">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-sm font-bold text-white group-hover/project:text-accent transition-colors flex-1 pr-2">{{ $project->title }}</h3>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" onclick="event.stopPropagation();" class="text-xs text-white/30 hover:text-accent transition-colors">
                                <i class="fab fa-github"></i>
                            </a>
                            @endif
                            @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" onclick="event.stopPropagation();" class="text-xs text-white/30 group-hover/project:text-accent transition-colors">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    @if($project->description)
                    <p class="text-[10px] text-white/50 mb-3 line-clamp-2 leading-relaxed">
                        {{ $project->description }}
                    </p>
                    @endif
                    @if($project->tags && count($project->tags) > 0)
                    <div class="flex flex-wrap gap-1.5 mt-2">
                        @foreach($project->tags as $tag)
                        <span class="text-[9px] px-2 py-0.5 rounded bg-blue-500/10 text-blue-400 border border-blue-500/20 font-mono whitespace-nowrap">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Social Links Section -->
        @if($socialLinks->count() > 0)
        <div class="mt-4 bg-card/60 backdrop-blur-md border border-white/5 rounded-2xl p-5 relative overflow-hidden group hover:border-white/10 transition-all duration-300">
            <!-- Header Section -->
            <h2 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-accent/20 flex items-center justify-center text-accent">
                    <i class="fas fa-paper-plane text-xs"></i>
                </div>
                <span class="font-sans">Let's Connect</span>
            </h2>

            <!-- Links Grid -->
            <div class="space-y-3">
                @foreach($socialLinks as $link)
                    @if($link->type === 'email')
                    <button onclick="copyEmail('{{ $link->url ?? $profile->email }}')" class="w-full group/link relative overflow-hidden bg-white/5 hover:bg-red-500/20 border border-white/5 hover:border-red-500/50 p-3 rounded-xl transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg {{ $link->color_class ?? 'bg-red-500/20' }} flex items-center justify-center {{ $link->color_class ? str_replace('bg-', 'text-', $link->color_class) : 'text-red-500' }} group-hover/link:scale-110 transition-transform">
                                <i class="{{ $link->icon_class }} text-lg"></i>
                            </div>
                            <span class="text-sm font-medium text-white/80 group-hover/link:text-white font-sans">{{ $link->name }}</span>
                        </div>
                        <div class="text-xs text-white/30 group-hover/link:text-white/70 font-mono transition-colors" id="email-text-{{ $link->id }}">Copy Email</div>
                    </button>
                    @else
                    <a href="{{ $link->url ?? '#' }}" {{ $link->type === 'whatsapp' ? 'target="_blank"' : '' }} class="block w-full group/link relative overflow-hidden bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/30 p-3 rounded-xl transition-all duration-300 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg {{ $link->color_class ?? 'bg-white/10' }} flex items-center justify-center {{ $link->color_class ? str_replace('bg-', 'text-', str_replace('/20', '', $link->color_class)) : 'text-white' }} group-hover/link:scale-110 transition-transform">
                                <i class="{{ $link->icon_class }} text-lg"></i>
                            </div>
                            <span class="text-sm font-medium text-white/80 group-hover/link:text-white font-sans">{{ $link->name }}</span>
                        </div>
                        <i class="fas fa-arrow-right -translate-x-2 opacity-0 group-hover/link:translate-x-0 group-hover/link:opacity-100 transition-all text-white/50 text-xs"></i>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Footer -->
        @if($profile->footer_text)
        <footer class="mt-8 text-center">
            <p class="text-[10px] text-white/20 font-mono">{{ $profile->footer_text }}</p>
        </footer>
        @endif
    </main>

    <!-- Scripts -->
    <script>
        // --- 1. Typewriter Effect ---
        @php
            $defaultWords = ['Web Developer', 'Sleepy', 'UI/UX Designer', 'Gamer'];
            $typewriterWords = $profile->typewriter_words ?? $defaultWords;
        @endphp
        const words = @json($typewriterWords);
        let i = 0;
        let timer;

        function typeWriter() {
            const heading = document.getElementById("typewriter");
            const word = words[i];
            const current = heading.textContent;

            if (current.length < word.length) {
                heading.textContent = word.substring(0, current.length + 1);
                timer = setTimeout(typeWriter, 150); // Kecepatan mengetik
            } else {
                setTimeout(erase, 2000); // Tunggu sebelum menghapus
            }
        }

        function erase() {
            const heading = document.getElementById("typewriter");
            const current = heading.textContent;

            if (current.length > 0) {
                heading.textContent = current.substring(0, current.length - 1);
                timer = setTimeout(erase, 100); // Kecepatan menghapus
            } else {
                i = (i + 1) % words.length;
                typeWriter();
            }
        }

        // Mulai Typewriter
        typeWriter();


        // --- 2. Clock Script ---
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: false 
            });
            document.getElementById('clock').textContent = timeString + " Local";
        }
        setInterval(updateClock, 1000);
        updateClock();


        // --- 3. Copy Email ---
        function copyEmail(email) {
            navigator.clipboard.writeText(email).then(() => {
                @if($socialLinks->where('type', 'email')->first())
                const textElement = document.getElementById('email-text-{{ $socialLinks->where('type', 'email')->first()->id }}');
                if (textElement) {
                    const originalText = textElement.textContent;
                    
                    textElement.textContent = "Copied!";
                    textElement.classList.add('text-green-400');
                    
                    setTimeout(() => {
                        textElement.textContent = originalText;
                        textElement.classList.remove('text-green-400');
                    }, 2000);
                }
                @endif
            });
        }


        // --- 4. Background Particle Animation (Starfield) ---
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particlesArray = [];
        const numberOfParticles = 70; // Jumlah bintang

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2;
                this.speedX = (Math.random() * 0.5) - 0.25;
                this.speedY = (Math.random() * 0.5) - 0.25;
                this.opacity = Math.random() * 0.5 + 0.1;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                // Reset posisi jika keluar layar
                if (this.x > canvas.width) this.x = 0;
                if (this.x < 0) this.x = canvas.width;
                if (this.y > canvas.height) this.y = 0;
                if (this.y < 0) this.y = canvas.height;
            }
            draw() {
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.closePath();
                ctx.fill();
            }
        }

        function initParticles() {
            for (let i = 0; i < numberOfParticles; i++) {
                particlesArray.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
                particlesArray[i].draw();
            }
            requestAnimationFrame(animateParticles);
        }

        // Resize handler
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        initParticles();
        animateParticles();
    </script>
</body>
</html>

