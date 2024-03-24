@extends('@ui.layout')

@section('content')
    <section class="forms-section">
        <div class="forms">
            <div class="form-wrapper @if ($baseActive == 'connexion') is-active @endif">
                <button type="button" class="switcher switcher-login">
                    {{ __('auth.login') }}
                    <span class="underline"></span>
                </button>
                <form class="form form-login" action="{{ route('login') }}" method="post">
                    @csrf
                    <fieldset>
                        <legend>Saisissez vos identifiants de connexion.</legend>
                        <input class="connexion__mail" type="email" placeholder="{{ __('auth.email') }}"
                               name="email" id="email_connexion" required/>
                        @error('email')
                        <span class="connexion__error">{{ $message }}</span>
                        @enderror
                        <input class="connexion__password" type="password"
                               placeholder="{{ __('auth.password') }}" name="password" id="password_connexion"
                               required/>
                        @error('password')
                        <span class="connexion__error">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <sl-checkbox size="large" name="remember-me">{{__('auth.remember-me')}}</sl-checkbox>
                    <input class="btn__blue" type="submit" value="{{ __('auth.login-action') }}"/>
                    {{-- TODO: forgotten password --}}
                    {{-- <a class="connexion__miss-password">{{__('auth.forgot-password')}}</a> --}}
                </form>
            </div>
            <div class="form-wrapper @if ($baseActive == 'signup') is-active @endif">
                <button type="button" class="switcher switcher-signup">
                    {{ __('auth.signup') }}
                    <span class="underline"></span>
                </button>
                <form class="form form-signup" action="{{ route('signup') }}" method="post">
                    @csrf
                    <fieldset>
                        <legend>{{ __('auth.create-account') }}</legend>
                        <input class="inscription__name" type="name"
                               placeholder="{{ __('auth.nickname') }}" name="name" id="name_inscription" required/>
                        @error('name')
                        <span class="inscription__error">{{ $message }}</span>
                        @enderror
                        <input class="inscription__mail" type="email" placeholder="{{ __('auth.email') }}"
                               name="email" id="email_inscription" required/>
                        @error('email')
                        <span class="inscription__error">{{ $message }}</span>
                        @enderror
                        <input class="inscription__password" type="password"
                               placeholder="{{ __('auth.password') }}" name="password" id="password_inscription"
                               required/>
                        @error('password')
                        <span class="inscription__error">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <sl-checkbox size="large" name="remember-me">{{__('auth.remember-me')}}</sl-checkbox>
                    <input class="btn__blue" type="submit" value="{{ __('auth.signup-action') }}"/>
                </form>
            </div>
        </div>
    </section>
@endsection
