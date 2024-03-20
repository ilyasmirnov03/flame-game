<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="/manifest.json">
    @yield('meta')
    <title>FlameGame</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('assets')
</head>

<body class="daltonism-container">
@section('flame-active', 'active')
<main class="layout">
    @include('@ui.header')
    <div class="layout__main-section">
        @yield('content')
    </div>
    @include('@ui.nav')
</main>
@include('./fun_fact')

</body>

</html>
