@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/games.js'])
@endsection

@section('content')
    <section class="games">
        <h1 class="font dyslexie"> Choisissez votre défi </h1>
        @foreach($games as $game)
            <a href="{{ route($route, ['game' => $game['id'], 'group' => $group ?? null]) }}"
                @disabled($game['timeToNextGame'] !== null)>
                <img src="{{ asset($game['image']) }}" alt="Logo {{ $game['label'] }}">
                <h2 class="font dyslexie">{{ $game['label'] }}</h2>
                <img class="games__info" src="{{ asset('images/info.svg')}}" alt="Info" data-game-id="{{ $game['id'] }}">
            </a>
        @endforeach
    </section>
    <div id="gameModal" class="game__popup hidden">
        <div class="game__popup--content">
          <span class="close">&times;</span>
          <h2 class="dyslexie font">Description du jeu</h2>
          <p class="dyslexie font" id="gameDescription"></p>
        </div>
      </div>
@endsection
