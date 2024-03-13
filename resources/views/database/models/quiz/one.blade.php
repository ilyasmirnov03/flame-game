<tr hx-swap-oob="beforeend:tbody">
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