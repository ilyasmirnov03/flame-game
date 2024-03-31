@extends('@ui.layout')

@section('content')
    <section class="auth">
        <sl-tab-group class="auth__form">
            <sl-tab slot="nav" panel="login">{{ __('auth.login') }}</sl-tab>
            <sl-tab @if($signup) active @endif slot="nav" panel="signup">{{ __('auth.signup') }}</sl-tab>

            {{-- Login --}}
            <sl-tab-panel name="login">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <sl-input
                        label="{{__('auth.email')}}"
                        type="email"
                        name="email"
                        placeholder="email@example.com"
                        size="large"
                        required
                    ></sl-input>
                    @error('loginEmail')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <sl-input
                        label="{{ __('auth.password') }}"
                        type="password"
                        name="password"
                        size="large"
                        password-toggle
                        required>
                    </sl-input>
                    <sl-checkbox size="large" name="remember-me">{{__('auth.remember-me')}}</sl-checkbox>
                    <input class="btn__blue" type="submit" value="{{ __('auth.login-action') }}"/>
                    {{-- TODO: forgotten password --}}
                    {{-- <a class="connexion__miss-password">{{__('auth.forgot-password')}}</a> --}}
                </form>
            </sl-tab-panel>

            {{-- Signup --}}
            <sl-tab-panel name="signup">
                <form action="{{ route('signup') }}" method="post">
                    @csrf
                    <sl-input
                        label="{{ __('auth.nickname') }}"
                        size="large"
                        name="name"
                        required
                    ></sl-input>
                    <sl-input
                        label="{{__('auth.email')}}"
                        type="email"
                        size="large"
                        name="email"
                        placeholder="email@example.com"
                        required
                    ></sl-input>
                    @error('signupEmail')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <sl-input
                        label="{{ __('auth.password') }}"
                        type="password"
                        size="large"
                        name="password"
                        password-toggle
                        required>
                    </sl-input>
                    <sl-checkbox size="large" name="remember-me">{{__('auth.remember-me')}}</sl-checkbox>
                    <input class="btn__blue" type="submit" value="{{ __('auth.signup-action') }}"/>
                </form>
            </sl-tab-panel>
        </sl-tab-group>
    </section>
@endsection
