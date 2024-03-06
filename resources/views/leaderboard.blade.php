@extends('@ui.layout')

@section('content')
    <div class="">
        <a href="{{ route('leaderboard.solo.index') }}">Solo</a>
        <a href="{{ route('leaderboard.group.index') }}">Group</a>
    </div>
    <div class="leaderboard">
        <div class="leaderboard__podium">
            <div class="leaderboard__podium--second"></div>
            <div class="leaderboard__podium--first"></div>
            <div class="leaderboard__podium--tdird"></div>
        </div>
        <table class="leaderboard__ranking">
            <tbody class="ranking">
                @foreach ($ranking as $user)
                    <tr class="ranking">
                        <td class="ranking__rating ranking__cell">#{{ $user->rank }}</td>
                        <td class="ranking__name ranking__cell">{{ $user->name }}</td>
                        <td class="ranking__score ranking__cell">{{ $user->scores->sum('score') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="leaderboard__controls">
            <a href="{{ route('leaderboard.solo.page', ['page' => $page > 1 ? $page - 1 : 1]) }}">Précédent</a>
            <a href="{{ route('leaderboard.solo.page', ['page' => $page + 1]) }}">Suivant</a>
        </div>
    </div>
@endsection
