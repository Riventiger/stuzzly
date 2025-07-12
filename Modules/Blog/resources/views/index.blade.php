@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blog Posts</h1>
        <a href="{{ route('blog.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
            + New Post
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul>
            @foreach ($posts as $post)
                <li class="border-b border-gray-200 hover:bg-gray-50">
                    <a href="{{ route('blog.show', $post->id) }}" class="block px-4 py-4">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{ \Illuminate\Support\Str::limit(strip_tags($post->body), 120) }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
