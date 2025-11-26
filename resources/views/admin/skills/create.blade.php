@extends('admin.layout')

@section('title', 'Tambah Skill')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Skill</h1>

    <form method="POST" action="{{ route('admin.skills.store') }}">
        @csrf

        <div class="space-y-4">
            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon_class" class="block text-gray-700 text-sm font-bold mb-2">Icon Class (Font Awesome)</label>
                <input type="text" name="icon_class" id="icon_class" value="{{ old('icon_class') }}" 
                       placeholder="fab fa-html5" required
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Contoh: fab fa-html5, fas fa-code, fab fa-react</p>
                @error('icon_class')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="color_class" class="block text-gray-700 text-sm font-bold mb-2">Color Class (Tailwind)</label>
                <input type="text" name="color_class" id="color_class" value="{{ old('color_class') }}"
                       placeholder="text-orange-500"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-xs text-gray-500 mt-1">Contoh: text-orange-500, text-blue-500, text-green-500</p>
                @error('color_class')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('order')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
            <a href="{{ route('admin.skills.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

