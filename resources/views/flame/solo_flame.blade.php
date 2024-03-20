@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/flame_map.js'])
@endsection

@section('content')
    <section class="univ">
        <div class="univ__bg" data-score="{{ $score }}" data-total-score="{{ $totalScore }}" data-min-score="{{ $minScore }}">
            <object type="image/svg+xml" data="{{ asset('images/flame_bg/' . $imageName)}}" class="univ__bg--img"></object>
        </div>
        <a class="font dyslexie" href="{{ route('flame.select_game')}}"> Avancer </a>
    </section>
@endsection
