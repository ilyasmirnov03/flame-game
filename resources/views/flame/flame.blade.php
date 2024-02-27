@extends('@ui.layout')

@section('content')
    <a href="{{ route('flame.solo') }}">
        <div class="flamme__indiv">
            <img src="{{ asset('images/flamme_logo.svg') }}" alt="Skin de votre flame">
            <h1 class="font dyslexie"> Ma <br> flamme </h1>
            <h2 class="font dyslexie"> {{ $score }} </h2>
        </div>
    </a>
    <section class="allgroups">
        <h2 class="font dyslexie"> Mes groupes </h2>
        <div class="groups">
            @foreach ($user->userGroups as $group)
                <a href="{{ route('group.index', ['group' => $group]) }}" class="groups__div">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo de votre groupe">
                    <p class="font dyslexie"> {{ $group->name }} </p>
                </a>
            @endforeach
            <div class="groups__add">
                <img src="{{ asset('images/add.svg') }}" alt="Ajouter ou créer un groupe">
            </div>
        </div>
    </section>
@endsection
