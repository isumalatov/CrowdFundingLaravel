<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Laravel</title>
    <!-- Agrega tus enlaces a estilos CSS, scripts, etc., aquí -->
</head>
<body>
    
    <header>
    
        <nav>
            
            <a href="/dashboard">Dashboard</a> |
            <a href="/projects">Projects</a> |
            <a href="/contributions">Contributions</a>
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
