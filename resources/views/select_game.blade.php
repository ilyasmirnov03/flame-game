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
    <section class="games">
        <h1> Choisissez votre défi </h1>
        @foreach(config('static.minigames') as $key => $minigame)
            <a href="{{ route('play', ['game' => $key]) }}">
                <img src="{{ asset($minigame['img']) }}" alt="Logo {{ $minigame['label'] }}">
                <h2>{{ $minigame['label'] }}</h2>
            </a>
        @endforeach
    </section>
</body>

</html>