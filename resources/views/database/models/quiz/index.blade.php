@extends('database.layout')

@section('content')
    <div>
        <form hx-post="{{route('database.quiz.store')}}" hx-swap="none">
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
            @foreach ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->label }}</td>
                    @foreach ($languages as $i => $language)
                        <td>
                            <p>{{ $quiz->translations[$i] ? $quiz->translations[$i]->question : '' }}</p>
                            <button hx-get="{{route('database.quiz-translation.edit', $quiz->translations[$i]->id)}}"
                                    hx-target="closest td">Edit
                            </button>
                        </td>
                    @endforeach
                    <td>
                        <form hx-delete="{{ route('database.quiz.destroy', $quiz->id) }}" hx-target="closest tr">
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
