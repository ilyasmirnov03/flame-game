<div id="popup">
    <p id="popupMessage" class="font dyslexie">{{ $message }}</p>
    <p id="popupResult" class="font dyslexie">{{__('game.result')}} : <span
                id="resultValue">{{$score}}</span> {{__('game.points')}}</p>
    @if($bonus > 0)
        <p id="bonusPoint" class="font dyslexie">{{$bonus}}</p>
    @endif
    <a href="{{route('flame.index')}}" class="btn__green font dyslexie">{{__('common.finish')}}</a>
</div>
