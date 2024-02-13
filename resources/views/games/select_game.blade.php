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
    @section('flame-active', 'active')
    @include('globals/nav')
    @include('globals/header')
    <section class="games">
        <h1> Choisissez votre défi </h1>
        @foreach(config('static.minigames') as $key => $minigame)
            <a href="{{ route('game-' . $minigame['route']) }}">
                <img src="{{ asset($minigame['img']) }}" alt="Logo {{ $minigame['label'] }}">
                <h2>{{ $minigame['label'] }}</h2>
                <img class="games__info" src="{{ asset('images/info.svg')}}" alt="Info">
            </a>
        @endforeach
    </section>
</body>

</html>