<div id="funFactPopup" class="funfact">
    <div class="funfact__content">
        <h2 class="funfact__content--title">{{ $dailyFunFact->label }}</h2>
        @if(!empty($dailyFunFact->translations) && !$dailyFunFact->translations instanceof Illuminate\Support\Collection)
            @php
                $dailyFunFact->translations = collect($dailyFunFact->translations);
            @endphp
        @endif
        @if(!$dailyFunFact->translations->isEmpty())
            <p class="funfact__content--desc">{{ $dailyFunFact->translations->first()->fact }}</p>
        @else
            <p>Pas de description disponible</p>
        @endif
        <button class="close btn__blue"> Cool ! </button>
    </div>
</div>

