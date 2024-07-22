@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nueva Tarea</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            <i class="fas fa-save"></i> Guardar
        </button>
    </form>
</div>
@endsection

