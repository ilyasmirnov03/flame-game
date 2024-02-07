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

<body>
    <header class="header">
        <a href="{{route('home')}}" class="header__logo"> LOGO </a>
        <a class="header__link">
            <img src="{{ asset('images/pwa.svg')}}" alt="Télécharger la PWA">
        </a> 
        <a class="header__link">
            <img src="{{ asset('images/recompenses.svg')}}" alt="Voir ses récompenses">
        </a> 
        <a href="{{route('profil')}}" class="header__link">
            <img src="{{ asset('images/profil.svg')}}" alt="Voir son profil">
        </a>           
    </header>
</body>

</html>