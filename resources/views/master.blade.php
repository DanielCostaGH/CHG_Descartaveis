<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('/images/logo_light.svg') }}" type="image/svg+xml" style="margin-right:5px">
    @vite('public/css/app.css')
    <title>CHG Descartaveis</title>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    @vite('resources/js/app.js')
</body>
</html>