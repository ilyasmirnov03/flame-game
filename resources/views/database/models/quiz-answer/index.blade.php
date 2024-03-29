@extends('database.layout')

@section('content')
    <form hx-post="{{route('database.quiz-answer.store')}}" hx-swap="none">
        @csrf
        <label for="is_right">is_right</label>
        <input type="checkbox" name="is_right" id="is_right">
        <label for="quiz_question_id">Quiz</label>
        <select name="quiz_question_id" id="quiz_question_id">
            @foreach($quizIds as $id)
                <option value="{{$id['id']}}">{{$id['id']}}</option>
            @endforeach
        </select>
        <input type="submit" value="Save">
    </form>
    <table>
        <caption>Quiz answers</caption>
        <thead>
        <tr>
            <th>Quiz ID</th>
            @foreach ($languages as $language)
                <th>{{ $language->code }}</th>
            @endforeach
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->quiz_question_id }}</td>
                @foreach ($languages as $i => $language)
                    <td>
                        @php
                            $translation = $answer->translations->where('language_id', $language->id)->first();
                        @endphp

                        @if($translation)
                            <p>{{ $translation->answer }}</p>
                            <button hx-get="{{ route('database.quiz-answer-translation.edit', $translation->id) }}"
                                    hx-target="closest td">Edit
                            </button>
                        @else
                            <form hx-post="{{route('database.quiz-answer-translation.store')}}" hx-swap="this">
                                @csrf
                                <input type="hidden" name="language_id" value="{{$language->id}}">
                                <input type="hidden" name="quiz_answer_id" value="{{$answer->id}}">
                                <label for="answer">Answer</label>
                                <textarea type="text" id="answer" name="answer"></textarea>
                                <input type="submit" value="Save">
                            </form>
                        @endif
                    </td>
                @endforeach
                <td>
                    <form hx-delete="{{ route('database.quiz-answer.destroy', $answer->id) }}" hx-target="closest tr">
                        @csrf
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
