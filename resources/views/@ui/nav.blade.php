<nav class="navbar">
    <ul>
        <li class="{{ Request::is('anecdote') ? 'active' : '' }}  open-fun-fact-popup">
            <a>
                <img src="{{ asset('images/anecdote.svg') }}" alt="L'anecdote quotidienne">
            </a>
        </li>
        <li class="{{ Request::is('flame*') || Request::is('group*') ? 'active' : '' }}">
            <a href="{{ route('flame.index') }}">
                <img src="{{ asset('images/flame.svg') }}" alt="Ma flamme virtuel">
            </a>
        </li>
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/home.svg') }}" alt="Page d'accueil">
            </a>
        </li>
        <li class="{{ Request::is('leaderboard*') ? 'active' : '' }}">
            <a href="{{ route('leaderboard.solo.index') }}">
                <img src="{{ asset('images/score.svg') }}" alt="Découvrir le classement">
            </a>
        </li>
        <li class="{{ Request::is('settings') ? 'active' : '' }}">
            <a href="{{ route('settings') }}">
                <img src="{{ asset('images/params.svg') }}" alt="Ouvrir les paramètres">
            </a>
        </li>
    </ul>
</nav>
