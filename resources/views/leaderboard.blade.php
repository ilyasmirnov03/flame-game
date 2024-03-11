@extends('@ui.layout')

@section('content')
    <div class="">
        <a href="{{ route('leaderboard.solo.index') }}">Solo</a>
        <a href="{{ route('leaderboard.group.index') }}">Group</a>
    </div>
    <div class="leaderboard">
        @if ($page == 1)
            <div class="podium">
                <div class="podium__second">
                    <span>{{ $ranking[1]->name }}</span>
                    <img class="podium__avatar" src="{{ asset('images/avatar.png') }}" alt="">
                    <div class="podium__image">
                        <span>{{ $ranking[1]->scores->sum('score') }}</span>
                    </div>
                </div>
                <div class="podium__first">
                    <span>{{ $ranking[0]->name }}</span>
                    <img class="podium__avatar" src="{{ asset('images/avatar.png') }}" alt="">
                    <div class="podium__image">
                        <span>{{ $ranking[0]->scores->sum('score') }}</span>
                    </div>
                </div>
                <div class="podium__third">
                    <span>{{ $ranking[2]->name }}</span>
                    <img class="podium__avatar" src="{{ asset('images/avatar.png') }}" alt="">
                    <div class="podium__image">
                        <span>{{ $ranking[2]->scores->sum('score') }}</span>
                    </div>
                </div>
            </div>
        @endif
        <table class="leaderboard__ranking">
            <tbody class="ranking">
                @foreach ($ranking as $user)
                    @if ($user->rank > 3)
                        <tr class="ranking">
                            <td class="ranking__rating ranking__cell">#{{ $user->rank }}</td>
                            <td class="ranking__name ranking__cell">{{ $user->name }}</td>
                            <td class="ranking__score ranking__cell">{{ $user->scores->sum('score') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="leaderboard__controls">
            <a href="{{ route('leaderboard.solo.page', ['page' => $page > 1 ? $page - 1 : 1]) }}">Précédent</a>
            <a href="{{ route('leaderboard.solo.page', ['page' => $page + 1]) }}">Suivant</a>
        </div>
    </div>
@endsection
