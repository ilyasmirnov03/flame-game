@extends('@ui.layout')

@section('content')
    <div class="profilewrapper">
        <div class="profileInfos">
            <form method="POST" class="profileInfos__form">
                @csrf
                <input class="profileInfos__input font dyslexie" type="text" name="name" value="{{ $user->name }}">
                <input class="profileInfos__input font dyslexie" type="mail" name="email" value="{{ $user->email }}">
                @if ($message = Session::get('success'))
                    <span>{{ Session::get('success') }}</span>
                @endif
                <button class="profileInfos__submit">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="">
                </button>
            </form>
        </div>
        <div class="avatar">
            <h2 class="avatar__name font dyslexie">{{ $user->name }}</h2>
            <div class="avatar__displaywrapper">
                <img class="avatar__display" src="{{ asset('images/avatar.png') }}" alt="votre avatar">
            </div>
            <div class="avatar__edit">
                <a href="">
                    <img src="{{ asset('images/') }}" alt="chapeau">
                </a>
                <a href="">
                    <img src="{{ asset('images/') }}" alt="haut">
                </a>
                <a href="">
                    <img src="{{ asset('images/') }}" alt="bas">
                </a>
                <a href="">
                    <img src="{{ asset('images/') }}" alt="chaussures">
                </a>
                <a href="">
                    <img src="{{ asset('images/') }}" alt="flamme">
                </a>
            </div>
        </div>
    </div>
@endsection
