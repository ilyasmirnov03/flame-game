@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/running.js'])
@endsection

@section('content')
    <section>
        <h1>Votre course quotidienne</h1>
        <h2> Course </h2>

        <button id="startButton">Commencer</button>
        <p id="timer"><span id="timeDisplay">0:00</span></p>
        <p id="distanceDisplay"></p>
        <p id="result">Résultat : <span id="resultValue">-</span> points</p>
    </section>
@endsection
