@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/leave_group.js'])
@endsection

@section('content')
    <section class="univ">
        <div class="univ__params">
            <img src="{{ asset('images/group_icons/' . $group['image']) }}" alt="Logo">
            <h2> {{ $group['name'] }} </h2>
            <img id="params" class="univ__params--group" src="{{ asset('images/params.svg')}}" alt="Ouvrir les paramètres de groupe">
        </div>
        <div class="univ__bg">
            <img class="univ__bg--img" src="{{ asset('images/flamme_univ.png')}}" alt="Univers de votre flamme">
            <img class="univ__bg--logo" src="{{ asset('images/flamme_logo.svg')}}" alt="Skin de votre flamme">
            <p class="univ__bg--points"> {{ $score }}</p>
        </div>
        <a href="{{ route('group.select_game', ['group' => $group])}}"> Avancer </a>
    </section>
    <div class="hidden popupgrp" id="groupSettingsPopup">
        <img class="close" id="close" src="{{ asset('images/close.svg')}}" alt="Fermer">
        <form action="{{ route('group.leave', ['group' => $group]) }}" method="POST">
            @csrf
            <button class="btn" type="submit">Quitter le groupe</button>
        </form>
    </div>
@endsection
