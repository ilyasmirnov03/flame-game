<div id="funFactPopup" class="funfact">
    <div class="funfact__content">
        <h2 class="funfact__content--title font dyslexie">{{ $dailyFunFact->label }}</h2>
        @if(!empty($dailyFunFact->translations) && !$dailyFunFact->translations instanceof Illuminate\Support\Collection)
            @php
                $dailyFunFact->translations = collect($dailyFunFact->translations);
            @endphp
        @endif
        @if(!$dailyFunFact->translations->isEmpty())
            <p class="funfact__content--desc font dyslexie">{{ $dailyFunFact->translations->first()->fact }}</p>
        @else
            <p class="font dyslexie">Pas de description disponible</p>
        @endif
        <button class="close btn__blue font dyslexie"> Cool ! </button>
    </div>
</div>

