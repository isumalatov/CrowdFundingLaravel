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

<div class="container mt-5">
    <h2>About Us</h2>
    <p>
        Bienvenido a nuestra plataforma. Somos una empresa dedicada a conectar personas con proyectos emocionantes. 
        Nuestro objetivo es facilitar el financiamiento colectivo y ayudar a los creadores a hacer realidad sus ideas.
        A través de nuestra plataforma, los usuarios pueden descubrir proyectos innovadores y contribuir a su desarrollo.
        Únete a nuestra comunidad y sé parte del cambio.
    </p>
</div>

<div class="container mt-5">
    <h2>Contáctanos</h2>
    <p>
        Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos. Estamos aquí para ayudarte.
    </p>
    <form>
        <div class="mb-3">
            <label for="contact_name" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="contact_name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Correo Electrónico:</label>
            <input type="email" class="form-control" id="contact_email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="contact_message" class="form-label">Mensaje:</label>
            <textarea class="form-control" id="contact_message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
    </form>
</div>
