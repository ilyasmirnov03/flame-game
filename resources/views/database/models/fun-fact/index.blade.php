@extends('database.layout')

@section('content')
    <form hx-post="{{route('database.fun-fact.store')}}" hx-target="table tbody" hx-swap="beforeend">
        @csrf
        <label for="label">Label</label>
        <input type="text" id="label" name="label">
        <input type="submit" value="Save">
    </form>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Label</th>
            @foreach ($languages as $language)
                <th>{{ $language->code }}</th>
            @endforeach
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($funFacts as $funFact)
            <tr>
                <td>{{ $funFact->id }}</td>
                <td>{{ $funFact->label }}</td>
                @foreach ($languages as $i => $language)
                    @php
                        $translation = $funFact->translations->where('language_id', $language->id)->first();
                    @endphp
                    <td>
                        @if($translation)
                            <p>{{ $translation->fact }}</p>
                            <button hx-get="{{route('database.fun-fact-translation.edit', $translation->id)}}"
                                    hx-target="closest td">Edit
                            </button>
                        @else
                            <form hx-post="{{route('database.fun-fact-translation.store')}}" hx-swap="this">
                                @csrf
                                <input type="hidden" name="language_id" value="{{$language->id}}">
                                <input type="hidden" name="fun_fact_id" value="{{$funFact->id}}">
                                <label for="fact">Fact</label>
                                <textarea type="text" id="fact" name="fact"></textarea>
                                <input type="submit" value="Save">
                            </form>
                        @endif
                    </td>
                @endforeach
                <td>
                    <form hx-delete="{{ route('database.fun-fact.destroy', $funFact->id) }}" hx-target="closest tr">
                        @csrf
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
