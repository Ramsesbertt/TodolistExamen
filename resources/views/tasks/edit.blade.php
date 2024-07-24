@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Tarea') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <div>
                                <button type="button" class="btn {{ $task->status == 'Sin completar' ? 'btn-secondary' : 'btn-outline-secondary' }} me-2" onclick="updateStatus('Sin completar')">Sin completar</button>
                                <button type="button" class="btn {{ $task->status == 'Completado' ? 'btn-success' : 'btn-outline-success' }}" onclick="updateStatus('Completado')">Completado</button>
                            </div>
                            <input type="hidden" id="status" name="status" value="{{ $task->status }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus(status) {
        document.getElementById('status').value = status;
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => button.classList.remove('btn-secondary', 'btn-success', 'btn-outline-secondary', 'btn-outline-success'));
        if (status === 'Sin completar') {
            event.target.classList.add('btn-secondary');
            buttons[1].classList.add('btn-outline-success');
        } else {
            event.target.classList.add('btn-success');
            buttons[0].classList.add('btn-outline-secondary');
        }
    }
</script>
@endsection

