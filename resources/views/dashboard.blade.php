@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1 class="dashboard-title">Hola de nuevo, {{ Auth::user()->name }}</h1>

    
    <div class="dashboard-message">
        <p>Bienvenido a tu panel de control donde puedes gestionar tus proyectos, contribuciones, y más.</p>
    </div>
</div>
@endsection
