@extends('@ui.layout')

@section('content')
    <section class="params">
        <article class="params__top">
            <h1> {{ __('settings.title') }} </h1>
            <button class="reset__btn" id="resetButton">
                <img src="{{ asset('images/reset.svg')}}" alt="Reset settings">
            </button>
        </article>
        <article>
            <h2> {{ __('settings.languages') }} </h2>
            <sl-dropdown id="languageSelect">
                <sl-button slot="trigger" caret>{{ __('settings.language-choose') }}</sl-button>
                <sl-menu>
                    @foreach($locales as $locale)
                        <sl-menu-item @disabled($locale === app()->getLocale()) value="{{route('lang', $locale)}}">
                            {{ $locale }}
                        </sl-menu-item>
                    @endforeach
                </sl-menu>
            </sl-dropdown>
        </article>
        <article class="notif">
            <h2> {{ __('settings.notifications') }} </h2>
            <sl-switch size="large">{{ __('settings.inactivity-notification') }}</sl-switch>
            <sl-switch size="large">{{ __('settings.fun-fact-notification') }}</sl-switch>
        </article>
        <article class="access">
            <h2> {{ __('settings.accessibility') }} </h2>
            <sl-range id="fontSize" label="{{ __('settings.font-size') }}" min="1" max="32" step="1"
                      value="16"></sl-range>
            <sl-switch size="large" id="dyslexia">{{ __('settings.dyslexia-mode') }}</sl-switch>
            <sl-select id="selectColorBlindness" placeholder="{{ __('settings.none') }}"
                       label="{{ __('settings.color-blindness-mode') }}">
                <sl-option value="none">{{ __('settings.none') }}</sl-option>
                <sl-option value="protanopia">{{ __('settings.protanopia') }}</sl-option>
                <sl-option value="deuteranopia">{{ __('settings.deuteranopia') }}</sl-option>
                <sl-option value="tritanopia">{{ __('settings.tritanopia') }}</sl-option>
                <sl-option value="achromatopsia">{{ __('settings.achromatopsia') }}</sl-option>
            </sl-select>
            <sl-switch size="large" id="dark">{{ __('settings.dark-mode') }}</sl-switch>
        </article>
    </section>
@endsection
