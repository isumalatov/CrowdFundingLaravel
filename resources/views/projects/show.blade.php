@extends('layouts.app')

@section('content')
    <h1>Detalles del Proyecto</h1>

    <div>
        <h2>{{ $project->title }}</h2>
        <p><strong>Creador:</strong> {{ $project->user->name}}</p>
        <p><strong>Descripción:</strong> {{ $project->description }}</p>
        <p><strong>Fecha de Publicación:</strong> {{ $project->publication_date ? $project->publication_date->format('Y-m-d') : 'N/A' }}</p>
        <p><strong>Fecha a Finalizar:</strong> {{ $project->completion_date ? $project->completion_date->format('Y-m-d') : 'N/A' }}</p>
        <p><strong>Fondos Necesarios:</strong> {{ $project->required_funds }}</p>
    </div>

    <div>
        <h2>Contribuciones</h2>
        @if ($project->contributions->count() > 0)
            <ul>
                @foreach ($project->contributions as $contribution)
                    <li>{{ $contribution->user->name }} contribuyó con {{ $contribution->amount }}</li>
                @endforeach
            </ul>
        @else
            <p>No hay contribuciones para este proyecto.</p>
        @endif
    </div>

    <div>
        <!-- Botones -->
        <a href="{{ route('contributions.create', ['project_id' => $project->id]) }}" class="btn btn-success">Contribuir</a>
        <a href="{{ route('projects.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection
