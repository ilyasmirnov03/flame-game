@extends('@ui.layout')

@section('content')
    <div class="leaderboardLinks">
        <a class="leaderboardLinks__link font dyslexie" href="{{ route('leaderboard.solo.index') }}">Solo</a>
        <a class="leaderboardLinks__link font dyslexie" href="{{ route('leaderboard.group.index') }}">Group</a>
    </div>
    <div class="leaderboard">
        @if ($page == 1)
            <div class="podium">
                @if (count($ranking) >= 2)
                    <div class="podium__second">
                        <span class="font dyslexie">{{ $ranking[1]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[1]->image) }}" alt="">
                        <div class="podium__image">
                            <span class="font dyslexie">{{ $ranking[1]->scores_sum_score }}</span>
                        </div>
                    </div>
                @endif
                @if (count($ranking) >= 1)
                    <div class="podium__first">
                        <span class="font dyslexie">{{ $ranking[0]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[0]->image) }}" alt="">
                        <div class="podium__image">
                            <span class="font dyslexie">{{ $ranking[0]->scores_sum_score }}</span>
                        </div>
                    </div>
                @endif
                @if (count($ranking) >= 3)
                    <div class="podium__third">
                        <span class="font dyslexie">{{ $ranking[2]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[2]->image) }}" alt="">
                        <div class="podium__image">
                            <span class="font dyslexie">{{ $ranking[2]->scores_sum_score }}</span>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        <table role="presentation" class="leaderboard__ranking" aria-label="classement des joueurs">
            <tbody class="ranking">
                @foreach ($ranking as $rankable)
                    @if ($rankable->rank > 3)
                        <tr class="ranking @if ($rankable->id == Auth::id()) ranking--user @endif">
                            <td class="ranking__rating ranking__cell font dyslexie">#{{ $rankable->rank }}</td>
                            <td class="ranking__name ranking__cell font dyslexie">
                                {{ $rankable->name }} @if ($rankable->id == Auth::id()) (vous) @endif
                            </td>
                            <td class="ranking__score ranking__cell font dyslexie">{{ $rankable->scores_sum_score }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="leaderboard__controls">

            <a class="leaderboard__controlLink font dyslexie"
                @if (str_starts_with(Route::currentRouteName(), 'leaderboard.solo'))
                    href="{{ route('leaderboard.solo.page', ['page' => $page > 1 ? $page - 1 : 1]) }}"
                @else
                    href="{{ route('leaderboard.group.page', ['page' => $page > 1 ? $page - 1 : 1]) }}"
                @endif>Précédent</a>
            <a class="leaderboard__controlLink font dyslexie"
                @if (str_starts_with(Route::currentRouteName(), 'leaderboard.solo'))
                    href="{{ route('leaderboard.solo.page', ['page' => $page + 1]) }}"
                @else
                    href="{{ route('leaderboard.group.page', ['page' => $page + 1]) }}"
                @endif>Suivant</a>
        </div>
    </div>
@endsection
