<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Task Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-gray-100 flex flex-col">
            <div class="px-6 py-5 text-xl font-bold border-b border-gray-800">
                Task Manager
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="{{ route('tasks.index') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('tasks.*') ? 'bg-gray-800' : '' }}">
                    Tasks
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('profile.*') ? 'bg-gray-800' : '' }}">
                    Profile
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-gray-800">
                <div class="px-4 py-2 text-sm text-gray-400">
                    Logged in as {{ auth()->user()->name }}
                    <span class="block text-xs uppercase text-gray-500">{{ auth()->user()->role }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-gray-800 text-red-400">
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-sm">
                <div class="px-6 py-4">
                    <h1 class="text-lg font-semibold text-gray-800">@yield('header')</h1>
                </div>
            </header>

            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>