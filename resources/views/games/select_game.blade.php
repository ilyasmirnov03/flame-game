@extends('@ui.layout')

@section('content')
    <section class="games">
        <h1> Choisissez votre défi </h1>
        @foreach($games as $game)
            <a href="{{ route('flame.game', ['game' => $game['id']]) }}" @disabled($game['hasPlayed'])>
                <img src="{{ asset($game['image']) }}" alt="Logo {{ $game['label'] }}">
                <h2>{{ $game['label'] }}</h2>
                <img class="games__info" src="{{ asset('images/info.svg')}}" alt="Info">
            </a>
        @endforeach
    </section>
@endsection
