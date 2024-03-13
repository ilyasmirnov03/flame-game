@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/rewards.js'])
@endsection

@section('content')
<div class="rewards">
    <h2 class="rewards__title font dyslexie">{{ $totalPoints }} points</h2>

    <div class="rewards__div">
        <div class="rewards__div--total" style="height: {{ 100 - ($totalPoints / $maxScore * 100) }}%;"></div>
        <?php $isLeft = true; ?>
        @foreach ($allRewards->sortByDesc('score_needed') as $reward)
            <div class="reward__progress @if ($isLeft) reward__progress--left @else reward__progress--right @endif" style="height: {{ 100 - ($reward->score_needed / $maxScore * 100) }}%;">
                <div class="reward__content">
                    <img src="{{ $reward->icon }}" alt="{{ $reward->name }}">
                    @if ($userRewards->contains($reward))
                        <img class="reward__content--obt" src="{{ asset('images/checked.svg')}}" alt="Déjà obtenu">
                    @else
                        <form action="{{ route('rewards.obtain', ['rewardId' => $reward->id]) }}" method="post">
                            @csrf
                            <button class="reward__content--btn font dyslexie" type="submit" @if ($totalPoints < $reward->score_needed) disabled @endif>Obtenir</button>
                        </form>
                    @endif
                </div>
            </div>
            <?php $isLeft = !$isLeft; ?>
        @endforeach
    </div>
</div>
@endsection
