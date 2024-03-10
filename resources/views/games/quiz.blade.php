@extends('@ui.layout')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('assets')
    @vite('resources/js/quiz.js')
@endsection

@section('content')
    <button class="btn__blue begin">Commencer</button>
@endsection
