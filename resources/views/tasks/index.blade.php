@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Barra Lateral -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-tasks"></i> Tareas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i> Configuración
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido Principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Listado de tareas de {{ Auth::user()->name }}</h1>
                <div>
                    <a href="{{ route('tasks.create') }}" class="btn btn-success me-2">
                        <i class="fas fa-plus"></i> Nueva tarea
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-secondary"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Botón de Búsqueda -->
            <form action="{{ route('tasks.search') }}" method="GET" class="input-group mb-3">
                <input type="text" class="form-control" id="search" name="query" placeholder="Buscar tarea..." aria-label="Buscar tarea">
                <button class="btn btn-outline-secondary" type="submit" id="button-search">Buscar</button>
            </form>

            @if(request()->has('query'))
                <div class="mb-3">
                    <a href="{{ route('home') }}" class="btn btn-primary">Volver a la página principal</a>
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tarea</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->title }}</td>
                            <td>
                                <span class="badge {{ $task->status == 'Completado' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

