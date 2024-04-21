@extends('layouts.app')

@section('content')

    <h1>Crear Proyecto</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Fecha de publicacion (opcional) </label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" nullable></input>
        </div>
        <div class="mb-3">
            <label for="completion_date" class="form-label">Fecha a finalizar (opcional) </label>
            <input type="date" class="form-control" id="completion_date" name="completion_date" nullable></input>
        </div>
        <div class="mb-3">
            <label for="required_funds" class="form-label">Fondos necesarios (opcional) </label>
            <input type="numeric" class="form-control" id="required_funds" name="required_funds" nullable></input>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" class="btn btn-primary">Borrar</button>
        <a href="{{ route('projects.index') }}" class="btn btn-primary mb-3">Volver</a>

    </form>
@endsection
