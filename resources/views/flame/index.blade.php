@extends('@ui.layout')

@section('content')
    <a href="{{ route('flame.solo') }}">
        <div class="flamme__indiv">
            <img src="{{ asset('images/flamme_logo.svg') }}" alt="Flame skin">
            <h1> {{__('flame.my-flame')}} </h1>
            <h2> {{ $score }} </h2>
        </div>
    </a>
    <section class="allgroups">
        <h2>{{__('flame.groups')}}</h2>
        <div class="groups">
            @foreach ($user->userGroups as $group)
                <a href="{{ route('group.flame', ['group' => $group]) }}" class="groups__div">
                    @if(isset($group['image']) && $group['image'])
                        <img src="{{ asset('images/group_icons/' . $group['image']) }}" alt="Group logo">
                    @else
                        <img src="{{ asset('images/group_icons/Drapeau_France_VF.svg') }}" alt="Default logo">
                    @endif
                    <p> {{$group->name}} </p>
                </a>
            @endforeach
            <div class="groups__add" id="openPopup">
                <img src="{{ asset('images/add.svg')}}" alt="Add or create a group">
            </div>
            <div class="popup__content hidden" id="popupGroup">
                <a href="{{ route('group.create')}}">{{__('group.create')}}</a>
                <a href="{{ route('group.search')}}">{{__('group.join')}}</a>
                <span class="popup-close" id="closePopup">
                    <img src="{{ asset('images/close.svg')}}" alt="Close the popup">
                </span>
            </div>
        </div>
    </section>
@endsection
