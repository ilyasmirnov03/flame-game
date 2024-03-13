@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/libs/htmx.js'])
@endsection

@section('content')
    <section class="search_group">
        <div class="group__header">
            <a class="group__header--return" href="{{ route('flame.index') }}"> Retour </a>
            <input id="searchInput" class="group__header--search" placeholder="Rechercher..." type="text" name="search"
                   hx-target="#groupContainer"
                   hx-get="{{ route('group.content') }}"
                   hx-trigger="input delay:250ms"
                   hx-swap="innerHTML"
            >
        </div>
        <div class="container" id="groupContainer">
            @include('group.search_content', ['groups' => $groups])
        </div>
    </section>
@endsection
