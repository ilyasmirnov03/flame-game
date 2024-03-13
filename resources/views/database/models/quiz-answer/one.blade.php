<tr hx-swap-oob="beforeend:tbody">
    <td>{{ $answer->quiz_question_id }}</td>
    @foreach ($languages as $i => $language)
        <td>
            <p>{{ $answer->translations[$i]->answer }}</p>
            <button hx-get="{{route('database.quiz-answer-translation.edit', $answer->translations[$i]->id)}}"
                    hx-target="closest td">Edit
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
