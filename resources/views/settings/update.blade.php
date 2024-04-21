{{-- resources/views/settings/update.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>¡Hecho!</h1>
    <p>Serás redirigido al dashboard en unos momentos...</p>
</div>

<script>
    setTimeout(function() {
        window.location.href = "{{ route('dashboard') }}"; // Asegúrate de que la ruta 'dashboard' esté definida correctamente.
    }, 3000); // Redirecciona después de 3000 milisegundos (3 segundos)
</script>
@endsection
