@extends('@ui.layout')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('assets')
    @vite(['resources/js/running.js'])
@endsection

@section('content')
    @if(!is_null($group ?? null))
        <input type="hidden" name="group" value="{{ $group->id }}">
    @endif
    <section class="rungame" id="mainSection">
        <h1 class="rungame__title font dyslexie">Votre course quotidienne</h1>
        <h2 class="rungame__title--blue font dyslexie"> Course </h2>
        <img class="rungame__gif" src="{{ asset('images/runner.png')}}">
        <p class="rungame__timer font dyslexie" id="timer"><span id="timeDisplay">0:00</span></p>
        <button class="rungame__btn btn__blue font dyslexie" id="startButton">Commencer</button>
        <p class="rungame__distance font dyslexie" id="distanceDisplay"></p>
    </section>
    <div id="popup" class="hidden">
        <p id="popupMessage" class="font dyslexie"></p>
        <p id="popupResult" class="font dyslexie">Résultat : <span id="resultValue">-</span> points</p>
        <p id="bonusPoint" class="font dyslexie"></p>
    </div>
@endsection