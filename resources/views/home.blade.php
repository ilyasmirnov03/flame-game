@extends('@ui.layout')

@section('content')
<section class="home">
    <div class="home__today">
        <h2 class="home__today--title">Aujourd'hui :</h2>
        @if ($currentStep['data'])
        <div class="home__today--div">
            <p>{{ $currentStep['data']['ville'] }} - {{ $currentStep['data']['departement'] }}</p>
            <p>{{ $currentStep['data']['date'] }} - {{ $currentStep['data']['territoire'] }}</p>
        </div>
        @else
            <p class="home__today--error">{{ $currentStep['erreur'] }}.</p>
        @endif
    </div>

    <div class="home__tocome">
        <h2 class="home__tocome--title">Étapes à venir :</h2>
        @if (!empty($upcomingSteps))
            @foreach ($upcomingSteps as $etape)
                <div class="home__tocome--div">
                    <div class="home__tocome--div-txt">
                        <p><span class="home__ville"> {{ $etape['ville'] }}  </span> - {{ $etape['departement'] }}</p>
                        <p>{{ $etape['date'] }} - {{ $etape['territoire'] }}</p>
                    </div>
                    <a class="home__tocome--div-img" href="https://www.google.com/maps?q={{ $etape['geolocalisation']['latitude'] }},{{ $etape['geolocalisation']['longitude'] }}" target="_blank">
                        <img src="{{ asset('images/maps.svg')}}" alt="Ouvrir sur google maps">
                    </a>
                </div>
            @endforeach
        @else
            <p>Aucune étape à venir. Le parcours est terminé.</p>
        @endif
    </div>

    <div class="home__done">
        <h2 class="home__done--title">Étapes passées :</h2>
        @if (!empty($pastSteps))
            @foreach ($pastSteps as $etape)
                <div class="home__done--div">
                    <div class="home__done--div-txt">
                        <p> <span class="home__ville"> {{ $etape['ville'] }}  </span> - {{ $etape['departement'] }}</p>
                        <p>{{ $etape['date'] }} - {{ $etape['territoire'] }}</p>
                    </div>
                    <a class="home__done--div-txt" href="https://www.google.com/maps?q={{ $etape['geolocalisation']['latitude'] }},{{ $etape['geolocalisation']['longitude'] }}" target="_blank">
                        <img src="{{ asset('images/maps.svg')}}" alt="Ouvrir sur google maps">
                    </a>
                </div>
            @endforeach
        @else
            <p>Le parcours n'a pas encore débuté.</p>
        @endif
    </div>
</section>

@endsection
