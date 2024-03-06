@extends('@ui.layout')
<meta name="groupSearchRoute" content="{{ route('group.content') }}">
@section('assets')
    @vite(['resources/js/search.js'])
@endsection

@section('content')
<section class="search_group">
    <div class="group__header">
        <a class="group__header--return" href="{{ route('flame.index') }}"> Retour </a>
        <input id="searchInput" class="group__header--search" placeholder="Rechercher..." type="text" name="search" value="{{ $searchTerm }}">
    </div>
        @include('group._group_content', ['groups' => $groups])
</section>
@endsection