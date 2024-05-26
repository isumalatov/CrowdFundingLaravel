@extends('layouts.app')

@section('content')
<form action="{{ route('contributions.search') }}" method="POST">
    @csrf
<div class="contributions-container">
    <h1>Contribuciones</h1>
    <div class="contributions-form">
        <div class="form-group">
            <input type="text" name="precio" placeholder="Buscar por precio...">
            <button type="submit"  >Buscar</button>
        </div>
        <div class="form-group">
        <input type="text" name="proyecto" placeholder="Buscar por proyecto...">
        <button type="submit" name="btProducto">Buscar</button>
        </div>
    </div>
    </form>
    
    
    
    
    <table class="contributions-table">
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Contribución</th>
                <th>Fecha de Contribución</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contributions as $contribution)
            @if ($contribution->user_id === Auth::id())
            <tr>
                <td>{{ $contribution->Project->title }}</td>
                <td>{{ $contribution->amount }}</td>
                <td>{{ $contribution->contribution_date->format('Y-m-d') }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
