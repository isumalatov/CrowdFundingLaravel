@extends('layouts.app')

@section('content')
@php
    $found = false;
@endphp

@foreach ($contributions as $contribution)
    @if ($contribution->contribution_date == $fecha)
        <div>
            <p>busqueda exitosa {{ $contribution->amount }} {{ $contribution->contribution_date }}</p>
        </div>
        @php
            $found = true;
        @endphp
    @endif
@endforeach

@if (!$found)
    <div>
        <p>no existe ninguna contribucion con esa fecha: {{  $fecha  }} añade tambien la hora si no lo has hecho.</p>
    </div>
@endif
@endsection
