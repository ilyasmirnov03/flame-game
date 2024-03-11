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
                            <span>{{ $ranking[1]->scores->sum('score') }}</span>
                        </div>
                    </div>
                @endif
                @if (count($ranking) >= 1)
                    <div class="podium__first">
                        <span>{{ $ranking[0]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[0]->image) }}" alt="">
                        <div class="podium__image">
                            <span>{{ $ranking[0]->scores->sum('score') }}</span>
                        </div>
                    </div>
                @endif
                @if (count($ranking) >= 3)
                    <div class="podium__third">
                        <span>{{ $ranking[2]->name }}</span>
                        <img class="podium__avatar" src="{{ asset($ranking[2]->image) }}" alt="">
                        <div class="podium__image">
                            <span>{{ $ranking[2]->scores->sum('score') }}</span>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        <table class="leaderboard__ranking" aria-label="classement des joueurs">
            <tbody class="ranking">
                @foreach ($ranking as $rankable)
                    @if ($rankable->rank > 3)
                        <tr class="ranking">
                            <td class="ranking__rating ranking__cell">#{{ $rankable->rank }}</td>
                            <td class="ranking__name ranking__cell">{{ $rankable->name }}</td>
                            <td class="ranking__score ranking__cell">{{ $rankable->scores->sum('score') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="leaderboard__controls">
            <a class="leaderboard__controlLink" href="{{ route('leaderboard.solo.page', ['page' => $page > 1 ? $page - 1 : 1]) }}">Précédent</a>
            <a class="leaderboard__controlLink" href="{{ route('leaderboard.solo.page', ['page' => $page + 1]) }}">Suivant</a>
        </div>
    </div>
@endsection
