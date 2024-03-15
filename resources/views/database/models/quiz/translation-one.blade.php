<p>{{ $translation->question }}</p>
<button hx-get="{{route('database.quiz-translation.edit', $translation->id)}}" hx-target="closest td">Edit</button>
