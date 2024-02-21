<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlameGame</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="daltonism-container">
    @section('flamme-active', 'active')
    @include('nav')
    @include('header')
    <section class="minigame">
        <a class="minigame__return--a" href="{{ route('flame.select_game') }}"> <img class="minigame__return" src="{{ asset('images/return.svg')}}" alt="Retourner en arrière"> </a>
        <h1 class="minigame__header"> {{ $minigame['header'] }} </h1>
        <h2 class="minigame__title"> {{ $minigame['title'] }} </h2>
    </section>
</body>

</html>