<form action="/api/copies" method="post">
    @csrf
    
    <select name="book_id">
        @foreach ($books as $book)
                <option value="{{$book->book_id}}">{{$book->author}}: {{$book->title}}</option>
        @endforeach
    </select>
    
    <input type="submit" value="Ok">
</form>