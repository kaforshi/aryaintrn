<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">Admin Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('portfolio.index') }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-external-link-alt"></i> Lihat Portfolio
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Skills</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['skills'] }}</p>
                    </div>
                    <i class="fas fa-terminal text-4xl text-blue-500"></i>
                </div>
                <a href="{{ route('admin.skills.index') }}" class="text-blue-500 hover:text-blue-700 text-sm mt-2 inline-block">Kelola →</a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Work Experiences</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['work_experiences'] }}</p>
                    </div>
                    <i class="fas fa-briefcase text-4xl text-green-500"></i>
                </div>
                <a href="{{ route('admin.work-experiences.index') }}" class="text-green-500 hover:text-green-700 text-sm mt-2 inline-block">Kelola →</a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Projects</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['projects'] }}</p>
                    </div>
                    <i class="fas fa-code text-4xl text-purple-500"></i>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="text-purple-500 hover:text-purple-700 text-sm mt-2 inline-block">Kelola →</a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Social Links</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['social_links'] }}</p>
                    </div>
                    <i class="fas fa-paper-plane text-4xl text-pink-500"></i>
                </div>
                <a href="{{ route('admin.social-links.index') }}" class="text-pink-500 hover:text-pink-700 text-sm mt-2 inline-block">Kelola →</a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.profile.edit') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-user text-blue-500 text-xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Edit Profile</h3>
                    <p class="text-sm text-gray-600">Ubah informasi profil portfolio</p>
                </a>
                <a href="{{ route('admin.skills.create') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-plus text-green-500 text-xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Tambah Skill</h3>
                    <p class="text-sm text-gray-600">Tambahkan skill baru</p>
                </a>
                <a href="{{ route('admin.work-experiences.create') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-plus text-green-500 text-xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Tambah Work Experience</h3>
                    <p class="text-sm text-gray-600">Tambahkan pengalaman kerja baru</p>
                </a>
                <a href="{{ route('admin.projects.create') }}" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-plus text-green-500 text-xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Tambah Project</h3>
                    <p class="text-sm text-gray-600">Tambahkan project baru</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>

