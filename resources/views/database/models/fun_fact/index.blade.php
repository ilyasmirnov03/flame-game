@extends('database.layout')

@section('content')
    <form hx-post="{{route('database.fun-fact.store')}}" hx-target="table tbody" hx-swap="beforeend">
        @csrf
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
            <tr hx-get="{{ route('database.fun-fact.edit', $funFact->id) }}">
                <td>{{ $funFact->id }}</td>
                <td>{{ $funFact->label }}</td>
                @foreach ($languages as $i => $language)
                    <td>
                        {{ $funFact->translations[$i] ? $funFact->translations[$i]->fact : '' }}
                    </td>
                @endforeach
                <td>
                    <form hx-delete="{{ route('database.fun-fact.destroy', $funFact->id) }}">
                        @csrf
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
