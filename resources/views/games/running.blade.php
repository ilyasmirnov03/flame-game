@extends('@ui.layout')


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('assets')
    @vite(['resources/js/running.js'])
@endsection

@section('content')
    <section class="rungame" id="mainSection">
        <h1 class="rungame__title font dyslexie">Votre course quotidienne</h1>
        <h2 class="rungame__title--blue font dyslexie"> Course </h2>
        <img class="rungame__gif" src="{{ asset('images/runner.png')}}">
        <p class="rungame__timer font dyslexie" id="timer"><span id="timeDisplay">0:00</span></p>
        <button class="rungame__btn btn__blue font dyslexie" id="startButton">Commencer</button>
        <p class="rungame__distance font dyslexie" id="distanceDisplay"></p>
    </section>
    <div id="popup" class="hidden">
        <p id="popupMessage" class="font dyslexie"></p>
        <p id="popupResult" class="font dyslexie">Résultat : <span id="resultValue">-</span> points</p>
        <p id="bonusPoint" class="font dyslexie"></p>
    </div>
@endsection

{{-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Attache un gestionnaire d'événements au clic sur le bouton avec l'ID "test"
    $("#test").click(function() {

        // Date actuelle
        var now = new Date();
        var startedAt = now.toISOString();
        now.setMinutes(now.getMinutes() + 3);
        var finishedAt = now.toISOString();

        // Autres valeurs fictives
        var game = "running";

        // Envoi de données à l'API Laravel
        $.ajax({
            url: "/run_result",
            method: "POST",
            data: {
                startedAt: startedAt,
                finishedAt: finishedAt,
                game: game,
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            },
        });
    });
</script> --}}