@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/search.js'])
@endsection

@section('content')
<section class="search_group">
    <div class="group__header">
        <a class="group__header--return"  href="{{route('flame.index')}}" > Retour </a>
        <form id="searchForm" action="{{ route('group.type') }}" method="get">
            @csrf
            <input id="searchInput" class="group__header--search" placeholder="Rechercher..." type="text" name="search" value="{{ $searchTerm }}">
        </form>
    </div>
    <div class="container">
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
</section>
@endsection