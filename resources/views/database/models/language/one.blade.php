<tr hx-get="{{ route('database.language.edit', $language->id) }}" hx-swap-oob="beforeend:tbody">
    <td>{{ $language->id }}</td>
    <td>{{ $language->code }}</td>
    <td>
        <form hx-delete="{{ route('database.language.destroy', $language->id) }}">
            @csrf
            <button>Delete</button>
        </form>
    </td>
</tr>
