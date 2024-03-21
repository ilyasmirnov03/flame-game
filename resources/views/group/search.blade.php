@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/libs/htmx.js'])
@endsection

@section('content')
    <section class="search_group">
        <div class="group__header">
            <a class="group__header--return font dyslexie" href="{{ route('flame.index') }}"> {{__('common.back')}} </a>
            <input id="searchInput" class="group__header--search font dyslexie" placeholder="{{__('common.search')}}..."
                   type="text"
                   name="search"
                   hx-target="#groupContainer"
                   hx-get="{{ route('group.content') }}"
                   hx-trigger="input delay:250ms"
                   hx-swap="innerHTML"
            >
        </div>
        <div class="container font dyslexie" id="groupContainer">
            @include('group.search_content', ['groups' => $groups])
        </div>
    </section>
@endsection
