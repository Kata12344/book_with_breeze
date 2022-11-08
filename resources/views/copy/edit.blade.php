<form action="/api/copies/{{$copy->copy_id}}" method="post">
    @csrf
    {{method_field('PATCH')}}
    <!-- a name fontos, hogy a mező neve legyen! -->
    <p>Book_id: {{$copy->book_id}}</p>
    <!-- ha a könyvtárban van -->
    @if ($copy->user_id === 1)
        <!-- és selejtes -->
        @if ($copy->status === 2)
            <p>It can not be borrowed.</p>
        <!-- kikölcsönöznénk vagy leselejteznénk -->
        @else
            <select name="user_id" placeholder="User Id">
                @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <select name="status" placeholder="status">
                <option value=1> In a user </option>
                <option value=2> Waste </option>
            </select>
            <input type="submit" value="Ok">
        @endif
    @else 
        <!-- különben vigyük vissza, azaz ne lehessen pl. leselejtezni rögtön -->
        <p>Back to the store.</p>
        <input type="submit" value="Ok">
    @endif
</form>
