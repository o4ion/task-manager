@extends('layouts.admin')

@section('header', 'Tasks')

@section('content')

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded border">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection