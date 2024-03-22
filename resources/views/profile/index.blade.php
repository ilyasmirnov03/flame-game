@extends('@ui.layout')

@section('content')
    <div class="profilewrapper">
        <div class="flame">
            <img class="flame__img" src="{{ asset('images/flamme_logo.svg') }}" alt="Skin de votre flame">
            <div class="flame__scorewrapper">
                <h1 class="flame__score font dyslexie"> {{__('game.score')}} </h1>
                <h2 class="flame__score font dyslexie"> {{$user->scores->sum('score')}} </h2>
            </div>
        </div>
        <div class="avatar">
            <h2 class="avatar__name font dyslexie">{{ $user->name }}</h2>
            <div class="avatar__displaywrapper">
                <img class="avatar__display" src="{{ asset('images/avatar.png') }}" alt="votre avatar">
            </div>
            @if (Auth::id() === $user->id)
                <a class="avatar__edit" href="{{ route('profile.edit') }}">
                    <img src="{{ asset('images/edit.svg') }}" alt="modifier le profil">
                </a>
            @endif
        </div>
        @if (Auth::id() === $user->id)
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="logout__button font dyslexie">{{__('auth.logout')}}</button>
            </form>
        @endif
    </div>
@endsection
