<nav class="navbar">
    <ul>
        <li class="{{ Request::is('anecdote') ? 'active' : '' }}">
            <a>
                <img src="{{ asset('images/anecdote.svg')}}" alt="L'anecdote quotidienne">
            </a>
        </li>
        <li class="{{ Request::is('flame*') ? 'active' : '' }}">
            <a href="{{ route('flame') }}">
                <img src="{{ asset('images/flamme.svg')}}" alt="Ma flamme virtuel">
            </a>
        </li>        
        <li class="{{ Request::is('/') ? 'active' : '' }}">
            <a href="{{ route('home') }}"> 
                <img src="{{ asset('images/home.svg')}}" alt="Page d'accueil"> 
            </a>
        </li>
        <li class="{{ Request::is('score') ? 'active' : '' }}">
            <a href="{{ route('score') }}">
                <img src="{{ asset('images/score.svg')}}" alt="Découvrir le classement">
            </a>
        </li>
        <li class="{{ Request::is('params') ? 'active' : '' }}">
            <a href="{{ route('params') }}">
                <img src="{{ asset('images/params.svg')}}" alt="Ouvrir les paramètres">
            </a>
        </li>
    </ul>
</nav>