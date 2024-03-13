<form hx-patch="{{route('database.quiz-answer-translation.update', $translation->id)}}" hx-swap="this">
    @csrf
    <input type="hidden" name="language_id" value="{{$translation->id}}">
    <label for="answer">Answer</label>
    <input type="text" id="answer" name="answer" value="{{$translation->answer}}">
    <input type="submit" value="Update">
</form>