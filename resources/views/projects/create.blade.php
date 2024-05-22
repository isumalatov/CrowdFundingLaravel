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
            <label for="publication_date" class="form-label">Fecha de publicación</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date">
        </div>
        <div class="mb-3">
            <label for="completion_date" class="form-label">Fecha a finalizar</label>
            <input type="date" class="form-control" id="completion_date" name="completion_date">
        </div>
        <div class="mb-3">
            <label for="required_funds" class="form-label">Fondos necesarios</label>
            <input type="number" class="form-control" id="required_funds" name="required_funds">
        </div>

        <h3>Recompensas</h3>
        <div id="rewards-container">
            <div class="reward mb-3">
                <label for="rewards_0_title" class="form-label">Título de la Recompensa</label>
                <input type="text" class="form-control" id="rewards_0_title" name="rewards[0][title]" required>
                <label for="rewards_0_description" class="form-label">Descripción</label>
                <textarea class="form-control" id="rewards_0_description" name="rewards[0][description]" rows="2" required></textarea>
                <label for="rewards_0_required_funds" class="form-label">Fondos Requeridos</label>
                <input type="number" class="form-control" id="rewards_0_required_funds" name="rewards[0][required_funds]" required>
                <label for="rewards_0_stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="rewards_0_stock" name="rewards[0][stock]" required>
                <button type="button" class="btn btn-danger mt-2 remove-reward">Eliminar Recompensa</button>
            </div>
        </div>
        <button type="button" id="add-reward" class="btn btn-secondary">Añadir Recompensa</button>

        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        <button type="reset" class="btn btn-secondary mt-3">Borrar</button>
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
