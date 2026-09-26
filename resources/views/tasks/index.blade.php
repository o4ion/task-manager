@extends('layouts.admin')

@section('header', 'Tasks')

@section('content')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex items-center justify-between">
                <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + New Task
                </a>

                <form method="GET" action="{{ route('tasks.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Search by title..."
                        class="border-gray-300 rounded-md shadow-sm">
                    <button type="submit" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Search</button>
                    @if ($search)
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded border">Clear</a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            @if (auth()->user()->role === 'admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tasks as $task)
                            <tr>
                                <td class="px-6 py-4">{{ $task->title }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                        {{ str_replace('_', ' ', $task->status) }}
                                    </span>
                                </td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-6 py-4">{{ $task->user->name ?? 'N/A' }}</td>
                                @endif
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No tasks yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tasks->links() }}
            </div>

        </div>
    </div>
@endsection