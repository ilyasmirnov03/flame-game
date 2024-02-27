@extends('@ui.layout')

@section('content')
    <div class="profilewrapper">
        <div class="flame">
            <img class="flame__img" src="{{ asset('images/flamme_logo.svg') }}" alt="Skin de votre flame">
            <div class="flame__scorewrapper">
                <h1 class="flame__score"> Score </h1>
                <h2 class="flame__score"> 3245 </h2>
            </div>
        </div>
        <div class="avatar">
            <h2 class="avatar__name dyslexie">{{ $user->name }}</h2>
            <div class="avatar__displaywrapper">
                <img class="avatar__display" src="{{ asset('images/avatar.png') }}" alt="votre avatar">
            </div>
            @if (Auth::user() == $user)
                <a class="avatar__edit" href="{{ route('profile.edit') }}">
                    <img src="{{ asset('images/edit.svg') }}" alt="modifier le profil"></a>
            @endif
        </div>
        @if (Auth::user() == $user)
            <form action="logout" method="POST">
                @csrf
                <button class="logout__button">
                    <h2 class="logout__message font dyslexie">Déconnexion</h2>
                </button>
            </form>
        @endif
    </div>
@endsection
