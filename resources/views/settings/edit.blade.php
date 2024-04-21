{{-- resources/views/profile/edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Perfil</h2>

    {{-- Si hay algún mensaje de sesión, mostrarlo --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para editar el perfil --}}
    <form action="{{ route('settings.update') }}" method="POST">
        @csrf
        @method('PUT') {{-- O POST si tu ruta de actualización lo requiere --}}

        {{-- Campo para el nombre --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        {{-- Campo para el correo electrónico --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        {{-- Campo para la contraseña nueva (opcional) --}}
        <div class="mb-3">
            <label for="password" class="form-label">Nueva Contraseña (introducir contraseña actual si no desea cambiarla):</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        {{-- Campo para confirmar la nueva contraseña --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        {{-- Botón para enviar el formulario --}}
        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>
@endsection
