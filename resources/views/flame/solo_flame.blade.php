@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/flame_map.js'])
@endsection

@section('content')
    <section class="univ">
        <div class="univ__bg" data-score="{{ $score }}">
            <img class="univ__bg--img" src="{{ asset('images/flame_bg/carte_1.svg')}}" alt="Skin de votre flamme">
            <img class="univ__bg--logo" src="{{ asset('images/flamme_logo.svg')}}" alt="Skin de votre flamme">
            <p id="score" class="univ__bg--points dyslexie"> {{ $score }}</p>
        </div>
        <a class="font dyslexie" href="{{ route('flame.select_game')}}"> Avancer </a>
    </section>
@endsection
