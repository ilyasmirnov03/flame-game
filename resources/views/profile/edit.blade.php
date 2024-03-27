@php use App\Enums\RewardPlayerPosition; @endphp
@extends('@ui.layout')

@section('content')
    <div class="profilewrapper">
        <div class="profileInfos">
            <form method="POST" class="profileInfos__form">
                @csrf
                <input class="profileInfos__input" type="text" name="name" value="{{ $user->name }}">
                <input class="profileInfos__input" type="email" name="email" value="{{ $user->email }}">
                @if ($message = Session::get('success'))
                    <span>{{ Session::get('success') }}</span>
                @endif
                <button class="profileInfos__submit">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="">
                </button>
            </form>
        </div>
        <div class="avatar">
            <h2 class="avatar__name">{{ $user->name }}</h2>
            <div class="avatar__displaywrapper">
                <img class="avatar__display" src="{{ asset('images/avatar.png') }}" alt="votre avatar">
            </div>
            <section class="avatar__edit">
                <article>
                    <sl-button>{{__('rewards.hat')}}</sl-button>
                    @foreach($rewards[RewardPlayerPosition::HEAD->value] as $reward)
                        {{$reward->label}}
                    @endforeach
                </article>
                <article>
                    <sl-button>{{__('rewards.top')}}</sl-button>
                    @foreach($rewards[RewardPlayerPosition::BODY->value] as $reward)
                        {{$reward->label}}
                    @endforeach
                </article>
                <article>
                    <sl-button>{{__('rewards.bottom')}}</sl-button>
                    @foreach($rewards[RewardPlayerPosition::LEGS->value] as $reward)
                        {{$reward->label}}
                    @endforeach
                </article>
                <article>
                    <sl-button>{{__('rewards.shoes')}}</sl-button>
                    @foreach($rewards[RewardPlayerPosition::FEET->value] as $reward)
                        {{$reward->label}}
                    @endforeach
                </article>
                <article>
                    <sl-button>{{__('rewards.flame')}}</sl-button>
                    @foreach($rewards[RewardPlayerPosition::FLAME->value] as $reward)
                        {{$reward->label}}
                    @endforeach
                </article>
            </section>
        </div>
    </div>
@endsection
