@extends('@ui.layout')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('assets')
    @vite('resources/js/quiz.js')
@endsection

@section('content')
    @if(!is_null($group ?? null))
        <input type="hidden" name="group" value="{{ $group->id }}">
    @endif

    <sl-drawer class="game-result"></sl-drawer>

    <button class="btn__blue begin">{{__('common.start')}}</button>

    <div class="quiz__container">
        @foreach($quiz as $question)
            <article data-quiz-id="{{$question['id']}}" class="hidden">
                <h2 class="quiz__title-style">{{__('game.question')}}</h2>
                <h2 class="quiz__title">{{$question['question']}}</h2>
                <ul class="quiz__answers">
                    @foreach($question['answers'] as $i => $answer)
                        <li>
                            <input type="radio" id="_answer{{$answer['id']}}" value="{{$answer['id']}}"
                                   name="answer"/>
                            <label for="_answer{{$answer['id']}}"
                                   class="answer answer__{{$i}} btn">{{$answer['answer']}}</label>
                        </li>
                    @endforeach
                </ul>
            </article>
        @endforeach
        <button class="btn confirm hidden" disabled>{{__('common.confirm')}}</button>
    </div>
@endsection
