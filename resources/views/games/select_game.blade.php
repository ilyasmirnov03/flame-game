@extends('@ui.layout')

@section('content')
    <section class="games">
        <h1> Choisissez votre défi </h1>
        @foreach(config('static.minigames') as $key => $minigame)
            <a href="{{ route('flame.game', ['game' => $key]) }}">
                <img src="{{ asset($minigame['img']) }}" alt="Logo {{ $minigame['label'] }}">
                <h2>{{ $minigame['label'] }}</h2>
                <img class="games__info" src="{{ asset('images/info.svg')}}" alt="Info">
            </a>
        @endforeach
    </section>
@endsection
