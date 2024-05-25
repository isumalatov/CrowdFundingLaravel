@extends('layouts.app')

@section('content')
    <div class="activity-container">
        <h1 class="activity-title">Mi Actividad</h1>

        <!-- Mis Proyectos -->
        <h2 class="activity-subtitle">Mis Proyectos</h2>

        <a href="{{ route('projects.create') }}" class="btn btn-success mb-3 create-activity-button">Crear Proyecto</a>
        
        @if ($projects->count() > 0)
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Fecha de Publicación</th>
                        <th>Fecha a Finalizar</th>
                        <th>Fondos Necesarios</th>
                        <th>Fondos Recaudados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td><a href="{{ route('projects.show', $project->id) }}" class="activity-table-link">{{ $project->title }}</a></td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->publication_date ? $project->publication_date->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : 'N/A' }}</td>
                            <td>{{ $project->required_funds }}</td>
                            <td>{{ $project->funds_raised }}</td>
                            <td>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary btn-activity-edit">Editar</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-activity-delete">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">{{ $projects->links() }}</div>
        @else
            <p>No tienes proyectos propios.</p>
        @endif

        <!-- Mis Recompensas -->
        <h2 class="activity-subtitle">Mis Recompensas</h2>
        @if ($rewards->count() > 0)
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>Recompensa</th>
                        <th>Descripción</th>
                        <th>Fecha de Contribución</th>
                        <th>Aportación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rewards as $reward)
                        <tr>
                            <td>{{ $reward->title }}</td>
                            <td>{{ $reward->description }}</td>
                            <td>{{ $reward->pivot->contribution_date }}</td>
                            <td>{{ $reward->pivot->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">{{ $rewards->links() }}</div>
        @else
            <p>No has obtenido recompensas.</p>
        @endif
    </div>
@endsection
