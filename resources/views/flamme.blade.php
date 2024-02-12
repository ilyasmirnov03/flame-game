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
    <a href="{{ route('flamme_indiv')}}">
        <div class="flamme__indiv">
            <img src="{{ asset('images/flamme_logo.svg')}}" alt="Skin de votre flame">
            <h1 class="font dyslexie"> Ma <br> flamme </h1>
            <h2 class="font dyslexie"> 3245 </h2>
        </div>
    </a>
    <section class="allgroups">
        <h2 class="font dyslexie"> Mes groupes </h2>
        <div class="groups">
            <div class="groups__div">
                <img src="{{ asset('images/logo.png')}}" alt="Logo de votre groupe">
                <p class="font dyslexie"> Nova </p>
            </div>
            <div class="groups__div">
                <img src="{{ asset('images/logo.png')}}" alt="Logo de votre groupe">
                <p class="font dyslexie"> Nova </p>
            </div>
            <div class="groups__add">
                <img src="{{ asset('images/add.svg')}}" alt="Ajouter ou créer un groupe">
            </div>
        </div>
    </section>
</body>

</html>