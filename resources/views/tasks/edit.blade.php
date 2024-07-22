@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Tarea</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            <i class="fas fa-save"></i> Actualizar
        </button>
    </form>
</div>
@endsection

