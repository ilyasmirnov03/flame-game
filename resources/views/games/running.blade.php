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
        <h1 class="rungame__title">{{__('game.run.title')}}</h1>
        <h2 class="rungame__title--blue">{{__('game.run')}}</h2>
        <img class="rungame__gif" src="{{ asset('images/runner.png')}}">
        <p class="rungame__timer" id="timer"><span id="timeDisplay">0:00</span></p>
        <button class="rungame__btn btn__blue" id="startButton">{{__('common.start')}}</button>
        <p class="rungame__distance">
            {{__('game.run.distance')}}: <span id="distanceDisplay">0 m</span>
        </p>
    </section>

    <article id="scoreResult"></article>
@endsection
