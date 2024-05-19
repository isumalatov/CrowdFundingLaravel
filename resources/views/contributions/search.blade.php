@extends('layouts.app')

@section('content')
@php
    $found = false;
@endphp

@foreach ($contributions as $contribution)
    
@if ($contribution->user_id === Auth::id())
    
        <div>
        <p>Proyecto: {{ $contribution->Project->title }}</p>
        <p>Contrubucion: {{ $contribution->amount }}</p>
        <p>Fecha de contribución: {{ $contribution->contribution_date }}</p>
        </div>
        @php
            $found = true;
        @endphp
    
@endif
@endforeach

@if (!$found)
    <div>
        <p>no existe ninguna contribucion con esa precio: {{  $precio  }} añade tambien la hora si no lo has hecho.</p>
    </div>
@endif
@endsection
