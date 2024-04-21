@extends('layouts.app')

@section('content')

    <h1>Detalles del Proyecto</h1>

    <div>
        <h2>{{ $project->title }}</h2>
        <p>{{ $project->description }}</p>
        <p>Fecha de Publicación: {{ $project->publication_date->format('d/m/Y') }}</p>
        <p>Fecha de Finalización: {{ $project->completion_date->format('d/m/Y') }}</p>
        <p>Fondos Requeridos: ${{ $project->required_funds }}</p>
        <!-- Agregar mas detalles si hiciera falta -->
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
