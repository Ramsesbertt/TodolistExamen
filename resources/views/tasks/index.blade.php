@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Barra lateral -->
        <div class="col-md-2 bg-light sidebar" id="sidebar">
            <h4 class="mt-4">Opciones</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.index') }}">Tareas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.calendar') }}">Calendario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.settings') }}">Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.kanban') }}">Kanban</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tasks.about') }}">Acerca de</a>
                </li>
            </ul>
        </div>
        
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <h2>Listado de tareas de {{ Auth::user()->name }}</h2>
                <div class="btn-group">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Agregar nueva tarea</a>
                    <a href="{{ route('logout') }}" class="btn btn-secondary"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Botón de Búsqueda -->
            <form action="{{ route('tasks.search') }}" method="GET" class="input-group mb-3" style="width: 50%;">
                <input type="text" class="form-control" id="search" name="query" placeholder="Buscar tarea..." aria-label="Buscar tarea">
                <button class="btn btn-success" type="submit" id="button-search">Buscar</button>
            </form>

            @if($tasks->isEmpty())
                <p>No hay tareas.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Prioridad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td class="align-middle">{{ $task->id }}</td>
                                <td class="align-middle">{{ $task->title }}</td>
                                <td class="align-middle">
                                    @if($task->status == 'Completado')
                                        <span class="badge bg-success">{{ $task->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $task->status }}</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($task->priority == 'Alta')
                                        <span class="badge bg-danger">{{ $task->priority }}</span>
                                    @elseif($task->priority == 'Media')
                                        <span class="badge bg-warning">{{ $task->priority }}</span>
                                    @else
                                        <span class="badge bg-info">{{ $task->priority }}</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm mx-1">Editar</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-1">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
