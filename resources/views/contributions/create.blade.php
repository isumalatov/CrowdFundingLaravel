@extends('layouts.app')

@section('content')
    <h1>Realizar una Contribución</h1>

    <form action="{{ route('payment.form') }}" method="GET">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project_id }}">
        <div class="mb-3">
            <label for="amount" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>

        <button type="submit" class="btn btn-primary">Realizar Contribución</button>
        <a href="{{ route('projects.show', $project_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
