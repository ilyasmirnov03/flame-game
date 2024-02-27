@extends('@ui.layout')

@section('content')
    <section class="univ">
        <div class="univ__bg">
            <img class="univ__bg--img" src="{{ asset('images/flamme_univ.png')}}" alt="Univers de votre flamme">
            <img class="univ__bg--logo" src="{{ asset('images/flamme_logo.svg')}}" alt="Skin de votre flamme">
            <p class="univ__bg--points"> {{ $score }}</p>
        </div>
        <a href="{{ route('flame.select_game')}}"> Avancer </a>
    </section>
@endsection
