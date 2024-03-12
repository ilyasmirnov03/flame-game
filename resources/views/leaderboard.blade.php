@extends('@ui.layout')

@section('content')
    <div class="leaderboardLinks">
        <a class="leaderboardLinks__link" href="{{ route('leaderboard.solo.index') }}">Solo</a>
        <a class="leaderboardLinks__link" href="{{ route('leaderboard.group.index') }}">Group</a>
    </div>
    <div class="leaderboard">
        @if ($page == 1)
            <div class="podium">
                @if (count($ranking) >= 2)
                    <div class="podium__second">
                        <span>{{ $ranking[1]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[1]->image) }}" alt="">
                        <div class="podium__image">
                            <span>{{ $ranking[1]->scores_sum_score }}</span>
                        </div>
                    </div>
                @endif
                @if (count($ranking) >= 1)
                    <div class="podium__first">
                        <span>{{ $ranking[0]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[0]->image) }}" alt="">
                        <div class="podium__image">
                            <span>{{ $ranking[0]->scores_sum_score }}</span>
                        </div>
                    </div>
                @endif
                @if (count($ranking) >= 3)
                    <div class="podium__third">
                        <span>{{ $ranking[2]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[2]->image) }}" alt="">
                        <div class="podium__image">
                            <span>{{ $ranking[2]->scores_sum_score }}</span>
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
                            <td class="ranking__rating ranking__cell">#{{ $rankable->rank }}</td>
                            <td class="ranking__name ranking__cell">
                                {{ $rankable->name }} @if ($rankable->id == Auth::id()) (vous) @endif
                            </td>
                            <td class="ranking__score ranking__cell">{{ $rankable->scores_sum_score }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="leaderboard__controls">

            <a class="leaderboard__controlLink"
                @if (str_starts_with(Route::currentRouteName(), 'leaderboard.solo'))
                    href="{{ route('leaderboard.solo.page', ['page' => $page > 1 ? $page - 1 : 1]) }}"
                @else
                    href="{{ route('leaderboard.group.page', ['page' => $page > 1 ? $page - 1 : 1]) }}"
                @endif>Précédent</a>
            <a class="leaderboard__controlLink"
                @if (str_starts_with(Route::currentRouteName(), 'leaderboard.solo'))
                    href="{{ route('leaderboard.solo.page', ['page' => $page + 1]) }}"
                @else
                    href="{{ route('leaderboard.group.page', ['page' => $page + 1]) }}"
                @endif>Suivant</a>
        </div>
    </div>
@endsection
