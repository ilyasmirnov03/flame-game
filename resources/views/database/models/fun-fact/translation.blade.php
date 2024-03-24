<form hx-patch="{{route('database.fun-fact-translation.update', $translation->id)}}" hx-swap="this">
    @csrf
    <input type="hidden" name="language_id" value="{{$translation->language_id}}">
    <label for="fact">Fact</label>
    <textarea type="text" id="fact" name="fact">{{$translation->fact}}</textarea>
    <input type="submit" value="Update">
</form>
