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
                    <img src="{{ asset('images/group_icons/' . $group['image']) }}" alt="Group logo">
                    <p> {{$group->name}} </p>
                </a>
            @endforeach
            <div class="groups__add" id="openPopup">
                <img src="{{ asset('images/add.svg')}}" alt="Add or create a group">
            </div>
        </div>
    </section>
    <sl-dialog class="group-join" label="{{__('group.new-dialog-title')}}">
        <a href="{{ route('group.create')}}" class="btn__green">{{__('group.create')}}</a>
        <a href="{{ route('group.search')}}" class="btn__green">{{__('group.join')}}</a>
    </sl-dialog>
@endsection
