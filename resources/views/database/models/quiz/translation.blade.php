<form hx-patch="{{route('database.quiz-translation.update', $translation->id)}}" hx-swap="this">
    @csrf
    <input type="hidden" name="language_id" value="{{$translation->language_id}}">
    <label for="question">Answer</label>
    <textarea type="text" id="question" name="question">{{$translation->question}}</textarea>
    <input type="submit" value="Update">
</form>
