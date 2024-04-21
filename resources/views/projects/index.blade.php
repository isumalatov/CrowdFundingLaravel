@extends('layouts.app')

@section('content')
    <h1>Lista de Proyectos</h1>

    <a href="{{ route('projects.create') }}" class="btn btn-success mb-3">Crear Proyecto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de Publicación</th>
                <th>Fecha a Finalizar</th>
                <th>Fondos Necesarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->user_id }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->publication_date ? $project->publication_date->format('Y-m-d') : 'N/A' }}</td>
                    <td>{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : 'N/A' }}</td>
                    <td>{{ $project->required_funds }}</td>
                    <td>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlaces de paginación -->
    {{ $projects->links() }}
@endsection