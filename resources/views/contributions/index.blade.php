@extends('layouts.app')

@section('content')
<form action="{{ route('contributions.search') }}" method="POST">
    @csrf
    <h1>Contribuciones</h1>
    <input type="text" name="precio" placeholder="Buscar por precio...">
    <button type="submit"  >Buscar</button>
    <input type="text" name="proyecto" placeholder="Buscar por proyecto...">
    <button type="submit" name="btProducto">Buscar</button>
</form>
@foreach ($contributions as $contribution)
<div>
    @if ($contribution->user_id === Auth::id())
        <p>Proyecto: {{ $contribution->Project->title }}</p>
        <p>Contrubucion: {{ $contribution->amount }}</p>
        <p>Fecha de contribución: {{ $contribution->contribution_date }}</p>
    @endif
</div>
    
@endforeach
{{ $contributions->links() }} <!-- Agregar enlaces de paginación -->
@endsection
