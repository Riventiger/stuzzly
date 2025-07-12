@extends('updatelogs::layouts.master')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Update Log #{{ $log->id }}</h1>
    <div class="bg-white p-4 rounded shadow">
        <p><strong>Module:</strong> {{ $log->module_name }}</p>
        <p><strong>Type:</strong> {{ $log->type }}</p>
        <p><strong>Status:</strong> 
            <span class="{{ $log->status === 'success' ? 'text-green-600' : 'text-red-600' }}">
                {{ ucfirst($log->status) }}
            </span>
        </p>
        <p><strong>Created At:</strong> {{ $log->created_at->toDayDateTimeString() }}</p>
        <hr class="my-4">
        <p><strong>Details:</strong></p>
        <pre class="bg-gray-100 text-sm p-3 rounded overflow-x-auto">{{ $log->details }}</pre>
    </div>
    <div class="mt-4">
        <a href="{{ route('updatelogs.index') }}" class="text-blue-600 hover:underline">← Back to logs</a>
    </div>
</div>
@endsection
