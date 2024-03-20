@if(count($groups) > 0)
    @foreach($groups as $group)
        <div class="group">
            <div class="group__info @if($group->is_member) member @endif">
                <h2 class=" font dyslexie">{{ $group->name }}</h2>
                <p class=" font dyslexie"> {{ $group->members_count }} / {{ $group->max_members }} </p>
                <p class=" font dyslexie"> {{ $group->scores_sum_score ?? 0 }} {{__('game.points')}}</p>
            </div>

            <form class="group__btn" action="{{route('group.join')}}" method="post">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <button type="submit" class="group__btn--join font dyslexie" @disabled($group->is_member)>
                    {{__('common.join')}}
                </button>
            </form>
        </div>
    @endforeach
@else
    <p class=" font dyslexie">{{__('group.no-group')}}</p>
@endif
