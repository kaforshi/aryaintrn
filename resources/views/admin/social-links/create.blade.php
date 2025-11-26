@extends('admin.layout')

@section('title', 'Tambah Social Link')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Social Link</h1>
    <form method="POST" action="{{ route('admin.social-links.store') }}">
        @csrf
        <div class="space-y-4">
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Icon Class</label>
                <input type="text" name="icon_class" value="{{ old('icon_class') }}" placeholder="fab fa-instagram" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">URL</label>
                <input type="text" name="url" value="{{ old('url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Color Class</label>
                <input type="text" name="color_class" value="{{ old('color_class') }}" placeholder="bg-pink-500/20" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                <select name="type" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                    <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Link</option>
                    <option value="email" {{ old('type') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="whatsapp" {{ old('type') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                </select></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
            <a href="{{ route('admin.social-links.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection

