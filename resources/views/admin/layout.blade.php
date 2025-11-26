<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Portfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">Admin Dashboard</a>
                    <a href="{{ route('admin.profile.edit') }}" class="text-gray-600 hover:text-gray-800">Profile</a>
                    <a href="{{ route('admin.skills.index') }}" class="text-gray-600 hover:text-gray-800">Skills</a>
                    <a href="{{ route('admin.work-experiences.index') }}" class="text-gray-600 hover:text-gray-800">Work Exp</a>
                    <a href="{{ route('admin.projects.index') }}" class="text-gray-600 hover:text-gray-800">Projects</a>
                    <a href="{{ route('admin.social-links.index') }}" class="text-gray-600 hover:text-gray-800">Social Links</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('portfolio.index') }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-external-link-alt"></i> Portfolio
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>
</body>
</html>

