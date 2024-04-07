<p>{{ $message }}</p>
<h2>{{$rightAnswersAmount}} / {{count($allQuestions)}}</h2>
<p>{{__('game.result')}} : {{$score}} {{__('game.points')}}</p>
@if($bonus > 0)
    <p id="bonusPoint">{{$bonus}}</p>
@endif
<section class="quiz__results">
    @foreach($allQuestions as $question)
        <article>
            <div class="flex justify-between gap-1 quiz__question">
                <p class="mt-0">{{$question['question']}}</p>
                <p @class([
                    'title',
                    'mt-0',
                    'quiz__won-points',
                    'none' => !$question['userAnswerIsRight']
                ])>
                    {{!$question['userAnswerIsRight'] ? 0 : $pointsPerRightAnswer}}
                </p>
            </div>
            <ul class="answer">
                @foreach($question['answers'] as $answer)
                    <li class="flex align-center gap-1">
                        @if($answer['is_right'] === true)
                            <sl-icon
                                class="green"
                                name="check-circle-fill">
                            </sl-icon>
                        @elseif(!$question['userAnswerIsRight'] && $question['userAnswer'] === $answer['id'])
                            <sl-icon
                                class="red"
                                name="x-circle-fill">
                            </sl-icon>
                        @endif
                        <p>{{$answer['answer']}}
                            @if($question['userAnswer'] === $answer['id'])
                                - {{__('game.quiz.your-answer')}}
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </article>
    @endforeach
</section>
<a href="{{route('flame.index')}}" class="btn__green">{{__('common.finish')}}</a>
