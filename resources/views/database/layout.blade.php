<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>FlameGame</title>
    @vite(['resources/css/database.css', 'resources/js/libs/htmx.js'])
    @yield('assets')
</head>

<body class="daltonism-container">
<main>
    @include('database.nav')
    @yield('content')
</main>
</body>

</html>