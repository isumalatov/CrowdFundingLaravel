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
            <label for="publication_date" class="form-label">Fecha de publicación</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ $project->publication_date ? $project->publication_date->format('Y-m-d') : '' }}">
        </div>
        <div class="mb-3">
            <label for="completion_date" class="form-label">Fecha a finalizar</label>
            <input type="date" class="form-control" id="completion_date" name="completion_date" value="{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : '' }}">
        </div>
        <div class="mb-3">
            <label for="required_funds" class="form-label">Fondos necesarios</label>
            <input type="number" class="form-control" id="required_funds" name="required_funds" value="{{ $project->required_funds }}">
        </div>

        <h3>Recompensas</h3>
        <div id="rewards-container">
            @foreach($project->rewards as $index => $reward)
                <div class="reward mb-3">
                    <label for="rewards_{{ $index }}_title" class="form-label">Título de la Recompensa</label>
                    <input type="text" class="form-control" id="rewards_{{ $index }}_title" name="rewards[{{ $index }}][title]" value="{{ $reward->title }}" required>
                    <label for="rewards_{{ $index }}_description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="rewards_{{ $index }}_description" name="rewards[{{ $index }}][description]" rows="2" required>{{ $reward->description }}</textarea>
                    <label for="rewards_{{ $index }}_required_funds" class="form-label">Fondos Requeridos</label>
                    <input type="number" class="form-control" id="rewards_{{ $index }}_required_funds" name="rewards[{{ $index }}][required_funds]" value="{{ $reward->required_funds }}" required>
                    <label for="rewards_{{ $index }}_stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="rewards_{{ $index }}_stock" name="rewards[{{ $index }}][stock]" value="{{ $reward->stock }}" required>
                    <button type="button" class="btn btn-danger mt-2 remove-reward">Eliminar Recompensa</button>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-reward" class="btn btn-secondary">Añadir Recompensa</button>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="{{ route('projects.my') }}" class="btn btn-secondary mb-3">Volver</a>
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('add-reward').addEventListener('click', function() {
        const rewardsContainer = document.getElementById('rewards-container');
        const index = rewardsContainer.children.length;
        const newReward = `
            <div class="reward mb-3">
                <label for="rewards_${index}_title" class="form-label">Título de la Recompensa</label>
                <input type="text" class="form-control" id="rewards_${index}_title" name="rewards[${index}][title]" required>
                <label for="rewards_${index}_description" class="form-label">Descripción</label>
                <textarea class="form-control" id="rewards_${index}_description" name="rewards[${index}][description]" rows="2" required></textarea>
                <label for="rewards_${index}_required_funds" class="form-label">Fondos Requeridos</label>
                <input type="number" class="form-control" id="rewards_${index}_required_funds" name="rewards[${index}][required_funds]" required>
                <label for="rewards_${index}_stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="rewards_${index}_stock" name="rewards[${index}][stock]" required>
                <button type="button" class="btn btn-danger mt-2 remove-reward">Eliminar Recompensa</button>
            </div>
        `;
        rewardsContainer.insertAdjacentHTML('beforeend', newReward);
    });

    document.getElementById('rewards-container').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-reward')) {
            e.target.closest('.reward').remove();
        }
    });
</script>
@endpush
