@extends('admin.layout')

@section('title', 'Edit Work Experience')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Work Experience</h1>
    <form method="POST" action="{{ route('admin.work-experiences.update', $workExperience) }}">
        @csrf @method('PUT')
        <div class="space-y-4">
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $workExperience->title) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Company</label>
                <input type="text" name="company" value="{{ old('company', $workExperience->company) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('description', $workExperience->description) }}</textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-gray-700 text-sm font-bold mb-2">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $workExperience->start_date?->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
                <div><label class="block text-gray-700 text-sm font-bold mb-2">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $workExperience->end_date?->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
            </div>
            <div><label class="flex items-center"><input type="checkbox" name="is_present" value="1" {{ old('is_present', $workExperience->is_present) ? 'checked' : '' }} class="form-checkbox"><span class="ml-2">Present</span></label></div>
            <div><label class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                <input type="number" name="order" value="{{ old('order', $workExperience->order) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"></div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
            <a href="{{ route('admin.work-experiences.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
        </div>
    </form>
</div>
@endsection

