{{-- resources/views/loginRegister/login.blade.php --}}

<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container">
    <h2>Iniciar Sesión</h2>
    
    {{-- Muestra un mensaje general de error si hay algún problema --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Recuérdame</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>

        <div class="mt-3">
            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
        </div>
    </form>
</div>


