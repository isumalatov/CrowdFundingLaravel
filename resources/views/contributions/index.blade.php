
@extends('layouts.app')

@section('content')
<form action="{{ route('contributions.search') }}" method="POST">
    @csrf
    <h1>Contribuciones</h1>
    <input type="text" name="fecha" placeholder="Buscar contribuciones...">
    <button type="submit">Buscar</button>
</form>
@foreach ($contributions as $contribution)

<div>
        <p>{{ $contribution->amount }} {{ $contribution->contribution_date }}</p>
</div>
@endforeach
@endsection
<!-- Mostrar los resultados de búsqueda aquí -->