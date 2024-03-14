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
                        <p>{{ $answer->translations[$i]->answer }}</p>
                        <button
                                hx-get="{{
                                    route('database.quiz-answer-translation.edit', $answer->translations[$i]->id)
                                }}"
                                hx-target="closest td">
                            Edit
                        </button>
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
