@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/leave_group.js'])
    @vite(['resources/js/flame_map.js'])
@endsection

@section('content')
    <section class="univ">
        <div class="univ__params">
            @if(isset($group['image']) && $group['image'])
                <img src="{{ asset('images/group_icons/' . $group['image']) }}" alt="Logo">
            @else
                <img src="{{ asset('images/group_icons/Drapeau_France_VF.svg') }}" alt="Logo par défaut">
            @endif
            <h2 class="font dyslexie"> {{ $group['name'] }} </h2>
            <img id="params" class="univ__params--group" src="{{ asset('images/params.svg')}}"
                 alt="Ouvrir les paramètres de groupe">
        </div>
        <div class="univ__bg" data-score="{{ $score }}" data-total-score="{{ $totalScore }}"
             data-min-score="{{ $minScore }}">
            <object type="image/svg+xml" data="{{ asset('images/flame_bg/' . $imageName)}}"
                    class="univ__bg--img"></object>
        </div>
        <a class="font dyslexie"
           href="{{ route('group.select_game', ['group' => $group])}}"> {{__('flame.progress')}} </a>
    </section>
    <div class="hidden popupgrp" id="groupSettingsPopup">
        <img class="close" id="close" src="{{ asset('images/close.svg')}}" alt="Fermer">
        <form action="{{ route('group.leave', ['group' => $group]) }}" method="POST">
            @csrf
            <button class="btn font dyslexie" type="submit">{{__('group.quit')}}</button>
        </form>
    </div>
@endsection
