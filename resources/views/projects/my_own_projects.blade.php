@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis Proyectos</h1>

        <!-- Botón para crear un nuevo proyecto -->
        <a href="{{ route('projects.create') }}" class="btn btn-success mb-3">Crear Proyecto</a>

        <table class="table table-bordered">
            <thead>
                <tr>
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
                        <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a></td>
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
    </div>
@endsection
