<p id="popupMessage">{{ $message }}</p>
<p id="popupResult">{{__('game.result')}} : <span
        id="resultValue">{{$score}}</span> {{__('game.points')}}</p>
@if($bonus > 0)
    <p id="bonusPoint">{{$bonus}}</p>
@endif
<a href="{{route('flame.index')}}" class="btn__green">{{__('common.finish')}}</a>
