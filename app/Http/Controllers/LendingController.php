<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LendingController extends Controller
{
    public function index(){
        $lendings =  Lending::all();
        return $lendings;
    }
    
    public function show($id)
    {
        $lending = Lending::find($id);
        return $lending;
    }
    public function destroy($id)
    {
        Lending::find($id)->delete();
    }
    public function store(Request $request)
    {
        $Lending = new Lending();
        $Lending->name = $request->name;
        $Lending->email = $request->email;
        $Lending->password = Hash::make($request->password);
        $Lending->permission = 1;
        $Lending->save();
    }

    public function update(Request $request, $id)
    {
        $Lending = Lending::find($id);
        $Lending->user_id = $request->user_id;
        $Lending->copy_id = $request->copy_id;
        $Lending->date = $request->date;
        $Lending->save();

    }

}
