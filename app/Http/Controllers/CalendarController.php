<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        
        $tasks = Task::whereNotNull('completed_at')->get();

        
        $tasksByDate = $tasks->groupBy(function($task) {
            return Carbon::parse($task->completed_at)->format('Y-m-d');
        });

        return view('calendar.index', compact('tasksByDate'));
    }
}

