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
    @include('nav')
    @include('header')
    <div class="profilwrapper">
        <div class="flame">
            <img class="flame__img" src="{{ asset('images/flamme_logo.svg') }}" alt="Skin de votre flame">
            <div class="flame__scorewrapper">
                <h1 class="flame__score"> Score </h1>
                <h2 class="flame__score"> 3245 </h2>
            </div>
        </div>
        <div class="avatar">
            <h2 class="avatar__name dyslexie">{{ $user->name }}</h2>
            <div class="avatar__displaywrapper">
                <img class="avatar__display" src="{{ asset('images/avatar.png') }}" alt="votre avatar">
            </div>
        </div>
        @if (Auth::user() == $user)
            <form action="logout" method="POST">
                @csrf
                <button class="logout__button">
                    <h2 class="logout__message font dyslexie">Déconnexion</h2>
                </button>
            </form>
        @endif
    </div>
</body>

</html>
