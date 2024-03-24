<tr hx-swap-oob="beforeend:tbody">
    <td>{{ $funFact->id }}</td>
    <td>{{ $funFact->label }}</td>
    @foreach ($languages as $i => $language)
        <td>
            <p>{{ $funFact->translations[$i] ? $funFact->translations[$i]->question : '' }}</p>
            <button hx-get="{{route('database.fun-fact-translation.edit', $funFact->translations[$i]->id)}}"
                    hx-target="closest td">Edit
            </button>
        </td>
    @endforeach
    <td>
        <form hx-delete="{{ route('database.fun-fact.destroy', $funFact->id) }}" hx-target="closest tr">
            @csrf
            <button>Delete</button>
        </form>
    </td>
</tr>
