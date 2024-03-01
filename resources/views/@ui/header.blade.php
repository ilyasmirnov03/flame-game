<header class="header">
    <a href="{{route('home')}}" class="header__logo"> LOGO </a>
    <a class="header__link">
        <img class="pwa__img" src="{{ asset('images/pwa.svg')}}" alt="Télécharger la PWA">
    </a>
    <a class="header__link">
        <img src="{{ asset('images/recompenses.svg')}}" alt="Voir ses récompenses">
    </a>
    <a href="{{route('profile')}}" class="header__link">
        <img src="{{ asset('images/profil.svg')}}" alt="Voir son profil">
    </a>
</header>

<script>
    window.pwaImagePath = "{{ asset('images/pwa.svg') }}";
    window.pwaWhiteImagePath = "{{ asset('images/pwa_white.svg') }}";
</script>