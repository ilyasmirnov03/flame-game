<p>{{ $translation->fact }}</p>
<button hx-get="{{route('database.fun-fact-translation.edit', $translation->id)}}" hx-target="closest td">Edit</button>
