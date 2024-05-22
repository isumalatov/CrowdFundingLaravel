@extends('layouts.app')

@section('content')
    <h1>Detalles del Proyecto</h1>

    <div>
        <h2>{{ $project->title }}</h2>
        <p><strong>Creador:</strong> {{ $project->user->name }}</p>
        <p><strong>Descripción:</strong> {{ $project->description }}</p>
        <p><strong>Fecha de Publicación:</strong> {{ $project->publication_date ? $project->publication_date->format('Y-m-d') : 'N/A' }}</p>
        <p><strong>Fecha a Finalizar:</strong> {{ $project->completion_date ? $project->completion_date->format('Y-m-d') : 'N/A' }}</p>
        <p><strong>Fondos Necesarios:</strong> {{ $project->required_funds }}</p>
        <p><strong>Fondos Recaudados:</strong> {{ $project->funds_raised }}</p>
    </div>

    <div>
        <h2>Recompensas</h2>
        @if ($project->rewards->count() > 0)
            <ul>
                @foreach ($project->rewards as $reward)
                    <li>
                        <h3>{{ $reward->title }}</h3>
                        <p><strong>Descripción:</strong> {{ $reward->description }}</p>
                        <p><strong>Fondos Requeridos:</strong> {{ $reward->required_funds }}</p>
                        <p><strong>Stock Restante:</strong> {{ $reward->stock }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No hay recompensas asociadas a este proyecto.</p>
        @endif
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


    <!-- Botones -->
    <div>
        <a href="{{ route('contributions.create', ['project_id' => $project->id]) }}" class="btn btn-success">Contribuir</a>
    </div>

    <div>
        <h2>Comentarios</h2>
        @if ($project->comments->count() > 0)
            <ul>
                @foreach ($project->comments as $comment)
                    <li>{{ $comment->user->name }}: {{ $comment->text }}</li>
                @endforeach
            </ul>
        @else
            <p>No hay comentarios en este proyecto.</p>
        @endif
        
        <div>
            <h3>Añadir un comentario</h3>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="form-group">
                    <label for="comment">Comentario:</label>
                    <textarea name="text" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publicar comentario</button>
            </form>
        </div>
    </div>
    

    <div>
        <a href="{{ route('projects.index') }}" class="btn btn-primary">Volver</a>
    </div>

@endsection
