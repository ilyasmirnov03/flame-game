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
    <section>
        <h1>Votre course quotidienne</h1>
        <h2> Course </h2>
    
        <button id="startButton">Commencer</button>
        <p id="timer"><span id="timeDisplay">0:00</span></p>
        <p id="distanceDisplay"></p>
        <p id="result">Résultat : <span id="resultValue">-</span> points</p>
    </section>
</body>

</html>