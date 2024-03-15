<header class="header">
    <a href="{{ route('home') }}" class="header__logo">
        <img src="{{ asset('/images/logo.svg') }}" alt="accueil">
    </a>
    <a href="{{ route('rewards.index') }}" class="header__link">
        <img src="{{ asset('images/recompenses.svg') }}" alt="Voir ses récompenses">
    </a>
    <a href="{{ route('profile.index') }}" class="header__link">
        <img src="{{ asset('images/profil.svg') }}" alt="Voir son profil">
    </a>
</header>

<script>
    window.pwaImagePath = "{{ asset('images/pwa.svg') }}";
    window.pwaWhiteImagePath = "{{ asset('images/pwa_white.svg') }}";
</script>
