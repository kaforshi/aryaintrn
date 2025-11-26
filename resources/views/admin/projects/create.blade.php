@extends('admin.layout')

@section('title', 'Tambah Project')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Project</h1>
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf
        <div class="space-y-4">
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('description') }}</textarea></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">URL</label>
                <input type="url" name="url" value="{{ old('url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Tags (pisahkan dengan koma)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" placeholder="HTML, Tailwind, JavaScript" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
            <a href="{{ route('admin.projects.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection

