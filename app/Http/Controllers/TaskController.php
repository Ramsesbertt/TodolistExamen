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
        $task->status = 'Pendiente'; 
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
        $tasks = Task::where('title', 'LIKE', "%{$query}%")->get();

        return view('tasks.index', compact('tasks'));
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Estado de la tarea actualizado correctamente');
    }

    public function calendar()
    {
        $tasks = Task::where('user_id', Auth::id())
                     ->where('status', 'Completado')
                     ->orderBy('completed_at')
                     ->get()
                     ->groupBy(function($date) {
                         return \Carbon\Carbon::parse($date->completed_at)->format('Y-m-d');
                     });

        return view('calendar.index', ['tasksByDate' => $tasks]);
    }

    public function settings()
    {
        return view('tasks.settings');
    }

    public function kanban()
    {
        return view('tasks.kanban');
    }

    public function about()
    {
        return view('tasks.about');
    }
}

