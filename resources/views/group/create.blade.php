@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/groups.js'])
@endsection

@section('content')
    <h2 class="group__title">{{__('group.create')}}</h2>

    <form class="group__form" action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Group name --}}
        <sl-input label="{{__('forms.name')}}" class="mb-5" size="large" maxlength="16" type="text" name="name"
                  required></sl-input>

        {{-- Group max members --}}
        <sl-range
            class="mb-5"
            label="{{__('group.max-members')}}"
            name="max_members"
            min="1"
            max="50"
            step="1"
            value="26">
        </sl-range>

        {{-- Is group private --}}
        <div class="mb-5">
            <sl-checkbox
                name="private"
                size="large">
                {{__('group.private')}}
            </sl-checkbox>
            <sl-tooltip content="{{__('group.private-help')}}" trigger="hover click">
                <sl-icon name="question-circle"></sl-icon>
            </sl-tooltip>
        </div>

        {{-- Icon choice --}}
        <div class="mb-5">
            <sl-button size="large" id="group-choice" class="mb-1">
                <sl-icon name="pencil" slot="prefix"></sl-icon>
                {{__('group.icon-action')}}
            </sl-button>
            <div class="group__icon--choice">
                <img src="{{ asset('images/group_icons/default.svg')}}" alt="{{__('group.selected-icon')}}">
            </div>
            <input type="hidden" id="icon" value="default.svg" name="icon" required>
        </div>

        <button class="btn__blue" type="submit">{{__('common.create')}}</button>
    </form>

    <sl-dialog label="{{__('group.icon-action')}}">
        <div id="groupIcons">
            @foreach($groupIcons as $icon)
                <img class="group__form--icon-option" src="/images/group_icons/{{$icon}}" alt="Group icon">
            @endforeach
        </div>
    </sl-dialog>
@endsection
