@extends('layouts.app')

@section('content')
    <h1>Editar Proyecto</h1>

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ $project->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Fecha de publicación </label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ $project->publication_date ? $project->publication_date->format('Y-m-d') : '' }}">
        </div>
        <div class="mb-3">
            <label for="completion_date" class="form-label">Fecha a finalizar </label>
            <input type="date" class="form-control" id="completion_date" name="completion_date" value="{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : '' }}">
        </div>
        <div class="mb-3">
            <label for="required_funds" class="form-label">Fondos necesarios </label>
            <input type="number" class="form-control" id="required_funds" name="required_funds" value="{{ $project->required_funds }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <!--<button type="reset" class="btn btn-primary">Borrar</button>-->
        <a href="{{ route('projects.my') }}" class="btn btn-primary mb-3">Volver</a>
    </form>
@endsection