@extends('@ui.layout')

@section('content')
<section class="home">
    <div class="home__today">
        <h2 class="home__today--title font dyslexie">Aujourd'hui :</h2>
        @if ($currentStep['data'])
        <div class="home__today--div location-card">
            <p class="font dyslexie">{{ $currentStep['data']['ville'] }} - {{ $currentStep['data']['departement'] }}</p>
            <p class="font dyslexie">{{ $currentStep['data']['date'] }} - {{ $currentStep['data']['territoire'] }}</p>
        </div>
        @else
            <p class="home__today--error font dyslexie">{{ $currentStep['erreur'] }}.</p>
        @endif
    </div>

    <div class="home__tocome">
        <h2 class="home__tocome--title font dyslexie">Étapes à venir :</h2>
        @if (!empty($upcomingSteps))
            @foreach ($upcomingSteps as $etape)
                <div class="home__tocome--div location-card">
                    <div class="home__tocome--div-txt">
                        <p class="font dyslexie"><span class="home__ville"> {{ $etape['ville'] }}  </span> - {{ $etape['departement'] }}</p>
                        <p class="font dyslexie">{{ $etape['date'] }} - {{ $etape['territoire'] }}</p>
                    </div>
                    <a class="home__tocome--div-img" href="https://www.google.com/maps?q={{ $etape['geolocalisation']['latitude'] }},{{ $etape['geolocalisation']['longitude'] }}" target="_blank">
                        <img src="{{ asset('images/maps.svg')}}" alt="Ouvrir sur google maps">
                    </a>
                </div>
            @endforeach
        @else
            <p class="font dyslexie">Aucune étape à venir. Le parcours est terminé.</p>
        @endif
    </div>

    <div class="home__done">
        <h2 class="home__done--title font dyslexie">Étapes passées :</h2>
        @if (!empty($pastSteps))
            @foreach ($pastSteps as $etape)
                <div class="home__done--div location-card">
                    <div class="home__done--div-txt">
                        <p class="font dyslexie"> <span class="home__ville"> {{ $etape['ville'] }}  </span> - {{ $etape['departement'] }}</p>
                        <p class="font dyslexie">{{ $etape['date'] }} - {{ $etape['territoire'] }}</p>
                    </div>
                    <a class="home__done--div-txt" href="https://www.google.com/maps?q={{ $etape['geolocalisation']['latitude'] }},{{ $etape['geolocalisation']['longitude'] }}" target="_blank">
                        <img src="{{ asset('images/maps.svg')}}" alt="Ouvrir sur google maps">
                    </a>
                </div>
            @endforeach
        @else
            <p class="font dyslexie">Le parcours n'a pas encore débuté.</p>
        @endif
    </div>
</section>

@endsection
