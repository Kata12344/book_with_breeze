<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Copy;
use App\Models\User;
use Illuminate\Http\Request;

class CopyController extends Controller
{
    //
    public function index(){
        $copies =  Copy::all();
        return $copies;
    }
    
    public function show($id)
    {
        $copies = Copy::find($id);
        return $copies;
    }
    public function destroy($id)
    {
        Copy::find($id)->delete();
    }
    public function store(Request $request)
    {
        $copy = new Copy();
        $copy->user_id = 1;
        $copy->book_id = $request->book_id;
        $copy->status = 0;
        $copy->save(); 
    }

    public function update(Request $request, $id)
    {
        //a book_id ne változzon! mert akkor már másik példányról van szó
        $copy = Copy::find($id);
        //ha a jelenlegi felhasználó nem a könyvtár, akkor visszahozza a könyvtárba...
        if ($copy->user_id != 1) 
            {
                //vissza kerül a könyvtárba
                $copy->user_id = 1;
                $copy->status = 0;
            }
        //különben kivehető, leselejtezhető...
        else
            {   //ha ki akarják venni...
                if ($request->user_id != 1){
                    $copy->user_id = $request->user_id;
                    //ha ki szeretné kölcsönözni valaki, akkor a státusz legyen 1
                    $copy->status = 1;
                }
                else{
                //le akarjuk selejtezni
                    $copy->user_id = 1;
                    $copy->status = 2;
                }
            }
        $copy->save();        
    }

    public function newView()
    {
        //új rekord(ok) rögzítése
        $users = User::all();
        $books = Book::all();
        return view('copy.new', ['users' => $users, 'books' => $books]);
    }

    public function editView($id)
    {
        $users = User::all();
        $books = Book::all();
        $copy = Copy::find($id);
        return view('copy.edit', ['users' => $users, 'books' => $books, 'copy' => $copy]);
    }

    public function listView()
    {
        $copies = Copy::all();
        //copy mappában list blade
        return view('copy.list', ['copies' => $copies]);
    }
}
