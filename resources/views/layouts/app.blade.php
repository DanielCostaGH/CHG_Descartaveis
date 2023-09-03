<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Inclua aqui seus estilos CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- Cabeçalho da sua aplicação -->
        <nav>
            <!-- Navegação, menu, etc. -->
        </nav>
    </header>

    <main>
        <!-- Conteúdo principal da página -->
        @yield('content')
    </main>

    <footer>
        <!-- Rodapé da sua aplicação -->
    </footer>

    <!-- Inclua aqui seus scripts JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>