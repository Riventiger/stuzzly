@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="mb-6">
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mt-1">Published {{ $post->created_at->diffForHumans() }}</p>
    </div>

    <div class="prose max-w-none mb-10">
        {!! nl2br(e($post->body)) !!}
    </div>

    <div class="flex justify-between items-center">
        <a href="{{ route('blog.index') }}" class="text-gray-600 hover:underline">← Back to Posts</a>

        <div class="space-x-2">
            <a href="{{ route('blog.edit', $post->id) }}"
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">
                Edit
            </a>

            <form action="{{ route('blog.destroy', $post->id) }}" method="POST" class="inline-block"
                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
