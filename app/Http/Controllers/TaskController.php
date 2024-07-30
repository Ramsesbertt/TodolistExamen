<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $task = new Task;
        $task->title = $request->title;
        $task->user_id = Auth::id();
        $task->status = 'Sin completar';
        $task->priority = 'Baja';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $tasks = Task::where('title', 'LIKE', "%{$query}%")->paginate(10);

        return view('tasks.index', compact('tasks'));
    }
}

