@extends('@ui.layout')

@section('content')
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button>Deconnexion</button>
    </form>
@endsection