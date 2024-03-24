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
            <caption>Quizzes</caption>
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
                            @php
                                $translation = $quiz->translations->where('language_id', $language->id)->first();
                            @endphp

                            @if($translation)
                                <p>{{ $translation->question }}</p>
                                <button hx-get="{{ route('database.quiz-translation.edit', $translation->id) }}"
                                        hx-target="closest td">Edit
                                </button>
                            @else
                                <form hx-post="{{route('database.quiz-translation.store')}}" hx-swap="this">
                                    @csrf
                                    <input type="hidden" name="language_id" value="{{$language->id}}">
                                    <input type="hidden" name="quiz_question_id" value="{{$quiz->id}}">
                                    <label for="question">Question</label>
                                    <input type="text" id="question" name="question">
                                    <input type="submit" value="Save">
                                </form>
                            @endif
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
