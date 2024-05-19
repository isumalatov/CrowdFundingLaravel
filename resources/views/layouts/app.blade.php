<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    
    <header>
    
        <nav>
            
            <a href="/dashboard">Dashboard</a> |
            <a href="/projects">Projects</a> |
            <a href="/contributions">Contributions</a> |
            <a href="{{ route('projects.my') }}" class="btn btn-primary">My Projects</a> |
            <a href="/settings">Settings</a> |
            <a href="/logout">Log out</a>
            <!-- Agrega más enlaces según sea necesario -->
        </nav>
    
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Pie de página -->
    </footer>

</body>
</html>
