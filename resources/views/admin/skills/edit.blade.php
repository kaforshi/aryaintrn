@extends('admin.layout')

@section('title', 'Edit Skill')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Skill</h1>

    <form method="POST" action="{{ route('admin.skills.update', $skill) }}">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $skill->name) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon_class" class="block text-gray-700 text-sm font-bold mb-2">Icon Class (Font Awesome)</label>
                <input type="text" name="icon_class" id="icon_class" value="{{ old('icon_class', $skill->icon_class) }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('icon_class')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="color_class" class="block text-gray-700 text-sm font-bold mb-2">Color Class (Tailwind)</label>
                <input type="text" name="color_class" id="color_class" value="{{ old('color_class', $skill->color_class) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('color_class')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $skill->order) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('order')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.skills.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

