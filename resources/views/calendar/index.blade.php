<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Tareas Completadas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 20px;
        }
        .calendar-day {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .task-completed {
            background-color: #28a745;
            color: white;
            padding: 5px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn-back {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Calendario de Tareas Completadas</h1>
        <a href="{{ route('home') }}" class="btn btn-primary btn-back">Regresar a la Página Principal</a>
        <div class="calendar">
            @foreach($tasksByDate as $date => $tasks)
                <div class="calendar-day">
                    <h4>{{ $date }}</h4>
                    @foreach($tasks as $task)
                        <div class="task-completed">
                            {{ $task->title }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

