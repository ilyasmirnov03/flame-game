@extends('@ui.layout')

@section('content')
<h2 class="group__title">Créer un groupe</h2>

<form class="group__form" action="{{ route('groups.store') }}" method="post">
    @csrf

    <input class="group__form--input" placeholder="Nom" type="text" name="name" required>

    <div class="group__form--range">
        <label class="group__form--range-label" for="max_members">Nombre de participants max</label>
        <input id="rangeInput" class="group__form--range-input" type="range" name="max_members" min="1" max="50" required>
        <span id="rangeValue" class="group__form--range-value">26</span>
    </div>

    <div class="group__form--toggle">
        <label class="group__form--toggle-label" for="private">Groupe privé:</label>
        <input class="group__form--toggle-input" type="checkbox" name="private">
    </div>
    
    <button class="btn__blue" type="submit">Créer</button>
</form>
@endsection