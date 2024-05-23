@extends('layouts.app')

@section('content')
    <h1>Pasarela de Pago</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="project_id" value="{{ request('project_id') }}">
        <input type="hidden" name="amount" value="{{ request('amount') }}">

        <div class="mb-3">
            <label for="card_name" class="form-label">Nombre en la Tarjeta</label>
            <input type="text" class="form-control" id="card_name" name="card_name" required>
        </div>

        <div class="mb-3">
            <label for="card_number" class="form-label">Número de Tarjeta</label>
            <input type="text" class="form-control" id="card_number" name="card_number" required>
        </div>

        <div class="mb-3">
            <label for="expiration_date" class="form-label">Fecha de Expiración</label>
            <input type="text" class="form-control" id="expiration_date" name="expiration_date" placeholder="MM/AA" required>
        </div>

        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" name="cvv" required>
        </div>
        <button type="submit" class="btn btn-primary">Pagar</button>
        <a href="{{ route('projects.show', request('project_id')) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
