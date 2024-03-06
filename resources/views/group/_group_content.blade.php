<div class="container" id="groupContainer">
    @foreach($groups as $group)
        <div class="group">
            <div class="group__info @if($group->is_member) member @endif">
                <h2>{{ $group->name }}</h2>
                <p> {{ $group->members()->count() }} / {{ $group->max_members }} </p>
                <p> {{ $group->total_score }} points</p>
            </div>

            <form class="group__btn" action="{{route('group.join')}}" method="post">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <button type="submit" class="group__btn--join" @if($group->is_member) disabled @endif>
                    Rejoindre
                </button>
            </form>
        </div>
    @endforeach
</div>