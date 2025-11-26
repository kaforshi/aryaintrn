@extends('admin.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Profile</h1>

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $profile->username) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('username')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="avatar" class="block text-gray-700 text-sm font-bold mb-2">Avatar URL</label>
                <input type="url" name="avatar" id="avatar" value="{{ old('avatar', $profile->avatar) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('avatar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $profile->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="typewriter_words" class="block text-gray-700 text-sm font-bold mb-2">Typewriter Words (pisahkan dengan koma)</label>
                <input type="text" name="typewriter_words" id="typewriter_words" 
                       value="{{ old('typewriter_words', is_array($profile->typewriter_words) ? implode(', ', $profile->typewriter_words) : $profile->typewriter_words) }}"
                       placeholder="Web Developer, Sleepy, UI/UX Designer"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('typewriter_words')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="footer_text" class="block text-gray-700 text-sm font-bold mb-2">Footer Text</label>
                <input type="text" name="footer_text" id="footer_text" value="{{ old('footer_text', $profile->footer_text) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('footer_text')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="verified" value="1" {{ old('verified', $profile->verified) ? 'checked' : '' }}
                               class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">Verified</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="status_online" value="1" {{ old('status_online', $profile->status_online) ? 'checked' : '' }}
                               class="form-checkbox h-5 w-5 text-green-600">
                        <span class="ml-2 text-gray-700">Status Online</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.dashboard') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

