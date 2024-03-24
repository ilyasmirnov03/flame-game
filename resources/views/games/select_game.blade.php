@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/games.js'])
@endsection

@section('content')
    <section class="games">
        <h1> {{__('flame.choose-game')}} </h1>
        @foreach($games as $game)
            <a href="{{ route($route, ['game' => $game['id'], 'group' => $group ?? null]) }}"
                    @disabled($game['timeToNextGame'] !== null)>
                <img src="{{ asset($game['image']) }}" alt="Logo {{ $game['label'] }}">
                <h2>{{ $game['label'] }}</h2>
                <img class="games__info" src="{{ asset('images/info.svg')}}" alt="Info"
                     data-game-id="{{ $game['id'] }}">
            </a>
        @endforeach
    </section>
    <div id="gameModal" class="game__popup hidden">
        <div class="game__popup--content">
            <span class="close">&times;</span>
            <h2 class="dyslexie">{{__('flame.description')}}</h2>
          <p class="dyslexie" id="gameDescription"></p>
        </div>
      </div>
@endsection
