@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blog.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block font-semibold text-gray-700">Title</label>
            <input type="text" name="title" id="title"
                   class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-6">
            <label for="body" class="block font-semibold text-gray-700">Body</label>
            <textarea name="body" id="body" rows="6"
                      class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                      required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('blog.index') }}" class="text-gray-600 hover:underline">← Back to Posts</a>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection
