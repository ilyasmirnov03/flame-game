<p>{{ $translation->answer }}</p>
<button hx-get="{{route('database.quiz-answer-translation.edit', $translation->id)}}" hx-target="closest td">
    Edit
</button>
