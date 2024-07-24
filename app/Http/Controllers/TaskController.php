<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
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
        $task->status = 'Sin completar'; // Establece el estado inicial
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
        $task->status = $request->status; // Actualiza el estado
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
        $tasks = Task::where('title', 'LIKE', "%{$query}%")->where('user_id', Auth::id())->get();

        return view('tasks.index', compact('tasks'));
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Estado de la tarea actualizado correctamente');
    }
}


