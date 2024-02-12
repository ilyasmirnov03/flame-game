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
        <a>
            <img src="{{ asset('images/quizz_logo.svg')}}" alt="Logo du Quizz">
            <h2> Quizz </h2>
        </a>
        <a>
            <img src="{{ asset('images/idk_logo.svg')}}" alt="Logo d'un autre défi">
            <h2> Autre </h2>
        </a>
        <a href="{{ route('course')}}">
            <img src="{{ asset('images/run_logo.svg')}}" alt="Logo de la Course">
            <h2> Course </h2>
        </a>
    </section>
</body>

</html>