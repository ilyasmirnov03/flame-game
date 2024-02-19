<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlameGame</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="daltonism-container">
    @include('nav')
    @include('header')
    <section class="forms-section">
        <div class="forms">
            <div class="form-wrapper @if ($baseActive == 'connexion') is-active @endif">
                <button type="button" class="switcher switcher-login">
                    Connexion
                    <span class="underline"></span>
                </button>
                <form class="form form-login" method="post">
                    @csrf
                    <fieldset>
                        <legend>Saisissez vos identifiants de connexion.</legend>
                        <input class="connexion__mail" type="email" placeholder="Adresse Mail" name="email"
                            id="email_connexion" required />
                        @error('email')
                            <span class="connexion__error">{{ $message }}</span>
                        @enderror
                        <input class="connexion__mdp" type="password" placeholder="Mot de passe" name="mdp"
                            id="mdp_connexion" required />
                        @error('password')
                            <span class="connexion__error">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <input class="btn__blue" type="submit" value="Connexion" />
                    <a class="connexion__miss-mdp" href="#"> Mot de passe oublié? </a>
                </form>
            </div>
            <div class="form-wrapper @if ($baseActive == 'inscription') is-active @endif">
                <button type="button" class="switcher switcher-signup">
                    Inscription
                    <span class="underline"></span>
                </button>
                <form class="form form-signup" method="post">
                    @csrf
                    <fieldset>
                        <legend>Créer votre compte.</legend>
                        <input class="inscription__name" type="name" placeholder="Votre pseudo" name="name"
                            id="name_inscription" required />
                        @error('name')
                            <span class="inscription__error">{{ $message }}</span>
                        @enderror
                        <input class="inscription__mail" type="email" placeholder="Adresse Mail" name="email"
                            id="email_inscription" required />
                        @error('email')
                            <span class="inscription__error">{{ $message }}</span>
                        @enderror
                        <input class="inscription__mdp" type="password" placeholder="Mot de passe" name="mdp"
                            id="mdp_inscription" required />
                        @error('password')
                            <span class="inscription__error">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <input class="btn__blue" type="submit" value="Inscription" />
                </form>
            </div>
        </div>
    </section>
</body>

</html>
