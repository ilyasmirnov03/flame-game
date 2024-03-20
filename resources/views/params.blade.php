@extends('@ui.layout')

@section('content')
    <section class="params">
        <div class="params__top">
            <h1 class="font dyslexie"> {{ __('settings.title') }} </h1>
            <button class="reset__btn" id="resetButton">
                <img src="{{ asset('images/reset.svg')}}" alt="{{ __('settings.Reset les paramètres') }}">
            </button>
        </div>
        <div>
            <h2 class="font dyslexie"> {{ __('settings.languages') }} </h2>
            @foreach($locales as $locale)
                <a href="{{route('lang', $locale)}}">{{ $locale }}</a>
            @endforeach
        </div>
        <div class="notif">
            <h2 class="font dyslexie"> {{ __('settings.notifications') }} </h2>
            <div class="notif__div">
                <p class="font dyslexie"> {{ __('settings.inactivity-notification') }} </p>
                <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="notif__div">
                <p class="font dyslexie"> {{ __('settings.fun-fact-notification') }} </p>
                <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <div class="access">
            <h2 class="font dyslexie"> {{ __('settings.accessibility') }} </h2>
            <div class="access__div--font">
                <label class="font dyslexie" for="fontSize">{{ __('settings.font-size') }}</label>
                <input type="range" id="fontSize" min="1" max="20" step="1" value="4">
            </div>
            <div class="access__div">
                <p class="font dyslexie"> {{ __('settings.dyslexia-mode') }} </p>
                <label class="toggle-switch">
                    <input id="dyslexie" type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="access__div">
                <p class="font dyslexie"> {{ __('settings.color-blindness-mode') }} </p>
                <select class="select" id="selectDaltonisme">
                    <option value="none">{{ __('settings.none') }}</option>
                    <option value="protanopia">{{ __('settings.protanopia') }}</option>
                    <option value="deuteranopia">{{ __('settings.deuteranopia') }}</option>
                    <option value="tritanopia">{{ __('settings.tritanopia') }}</option>
                    <option value="achromatopsia">{{ __('settings.achromatopsia') }}</option>
                </select>
            </div>
            <div class="access__div">
                <p class="font dyslexie"> {{ __('settings.dark-mode') }} </p>
                <label class="toggle-switch">
                    <input id="dark" type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </section>
@endsection
