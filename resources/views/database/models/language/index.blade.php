@extends('database.layout')

@section('content')
    <div>
        <form hx-post="{{route('database.language.store')}}" hx-swap="none">
            @csrf
            <label for="code">Code</label>
            <input type="text" id="code" name="code">
            <input type="submit" value="Save">
        </form>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($languages as $language)
                <tr hx-get="{{ route('database.language.edit', $language->id) }}">
                    <td>{{ $language->id }}</td>
                    <td>{{ $language->code }}</td>
                    <td>
                        <form hx-delete="{{ route('database.language.destroy', $language->id) }}">
                            @csrf
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection