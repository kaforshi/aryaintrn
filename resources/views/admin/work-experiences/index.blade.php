@extends('admin.layout')

@section('title', 'Work Experiences')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Work Experiences</h1>
        <a href="{{ route('admin.work-experiences.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Period</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($workExperiences as $exp)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $exp->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $exp->company }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($exp->is_present) Present @else {{ $exp->start_date?->format('Y') }} - {{ $exp->end_date?->format('Y') }} @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.work-experiences.edit', $exp) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="{{ route('admin.work-experiences.destroy', $exp) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

