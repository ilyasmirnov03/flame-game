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
    @include('nav')
    @include('header')
    <section class="univ">
        <div class="univ__bg">
            <img class="univ__bg--img" src="{{ asset('images/flamme_univ.png')}}" alt="Univers de votre flamme">
            <img class="univ__bg--logo" src="{{ asset('images/flamme_logo.svg')}}" alt="Skin de votre flamme">
            <p class="univ__bg--points"> 3245</p>
        </div>
        <a href="{{ route('select_game')}}"> Avancer </a>
    </section>
</body>

</html>