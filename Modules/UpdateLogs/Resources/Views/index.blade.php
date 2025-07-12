@extends('updatelogs::layouts.master')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Update Logs</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Module</th>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Created At</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $log->id }}</td>
                        <td class="px-4 py-2">{{ $log->module_name }}</td>
                        <td class="px-4 py-2">{{ $log->type }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs rounded {{ $log->status === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($log->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $log->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('updatelogs.show', $log->id) }}" class="text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
