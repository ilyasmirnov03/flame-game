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
    @section('params-active', 'active')
    @include('nav')
    @include('header')
    <section class="params">
        <div class="params__top">
            <h1 class="font dyslexie"> Paramètres </h1>
            <button class="reset__btn" id="resetButton">  <img src="{{ asset('images/reset.svg')}}" alt="Réinitialiser les paramètres"> </button>
        </div>
        <div class="notif">
            <h2 class="font dyslexie"> Notifications </h2>
            <div class="notif__div">
                <p class="font dyslexie"> Notification d'inactivité </p>
                <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="notif__div">
                <p class="font dyslexie"> Notification d'anecdote </p>
                <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <div class="access">
            <h2 class="font dyslexie"> Accessibilité </h2>
            <div class="access__div--font">
                <label class="font dyslexie" for="fontSize">Taille de la police</label>
                <input type="range" id="fontSize" min="1" max="20" step="1" value="4">
            </div>
            <div class="access__div">
                <p class="font dyslexie"> Mode dyslexie </p>
                <label class="toggle-switch">
                    <input  id="dyslexie" type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="access__div">
                <p class="font dyslexie"> Mode daltonisme </p>
                <select class="access__div--select" id="selectDaltonisme">
                    <option value="none">Aucun</option>
                    <option value="protanopia">Protanopia</option>
                    <option value="deuteranopia">Deuteranopia</option>
                    <option value="tritanopia">Tritanopia</option>
                    <option value="achromatopsia">Achromatopsia</option>
                </select>
            </div>
            <div class="access__div">
                <p class="font dyslexie"> Mode sombre </p>
                <label class="toggle-switch">
                    <input id="dark" type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </section>
</body>

</html>