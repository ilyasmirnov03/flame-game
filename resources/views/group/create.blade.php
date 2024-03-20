@extends('@ui.layout')

@section('assets')
    @vite(['resources/js/groups.js'])
@endsection

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <h2 class="group__title font dyslexie">{{__('group.create')}}</h2>

    <form class="group__form" action="{{ route('group.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <input class="group__form--input font dyslexie" maxlength="16" placeholder="{{__('forms.name')}}" type="text" name="name"
               required>

        <div class="group__form--range">
            <label class="group__form--range-label font dyslexie" for="max_members">{{__('group.max-members')}}</label>
            <input id="rangeInput" class="group__form--range-input" type="range" name="max_members" min="1" max="50"
                   required>
            <span id="rangeValue" class="group__form--range-value font dyslexie">26</span>
        </div>

        <div class="group__form--toggle">
            <label class="group__form--toggle-label font dyslexie" for="private">{{__('group.private')}}</label>
            <input class="group__form--toggle-input" type="checkbox" name="private">
        </div>

        <div class="group__form--icon">
            <label class="group__form--icon-label font dyslexie" for="groupIcon">{{__('group.icon-action')}}</label>
            <div id="group-choice" class="group__icon--choice">
                <img class="group__edit--img" src="{{ asset('images/edit.svg')}}" alt="Selectionner une icone">
            </div>
            <div id="group-popup" class="hidden group__icon--popup">
                <div id="groupIcon" class="group__form--icon-selection"></div>
            </div>

            <input type="hidden" id="icon" name="icon" required>
        </div>

        <button class="btn__blue font dyslexie" type="submit">{{__('common.create')}}</button>
    </form>

    <script>
        const groupIcons = {!! json_encode($groupIcons) !!};
    </script>
@endsection
