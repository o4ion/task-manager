<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
public function index(Request $request)
{
    $search = $request->query('search');

    $query = $request->user()->role === 'admin'
        ? Task::with('user')
        : Task::where('user_id', $request->user()->id);

    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    $tasks = $query->latest()->paginate(10)->withQueryString();

    return view('tasks.index', compact('tasks', 'search'));
}

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $validated['user_id'] = $request->user()->id;

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Request $request, Task $task)
    {
        $this->authorizeTask($request, $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($request, $task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorizeTask($request, $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    private function authorizeTask(Request $request, Task $task): void
    {
        if ($request->user()->role !== 'admin' && $task->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }
    }
}