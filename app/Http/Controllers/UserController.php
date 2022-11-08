<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index(){
        $users =  User::all();
        return $users;
    }
    
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }
    public function destroy($id)
    {
        User::find($id)->delete();
    }
    public function store(Request $request)
    {
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->permission = 1;
        $User->save();
    }

    public function update(Request $request, $id)
    {
        $User = User::find($id);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->permission = $request->permission;
        $User->save();

    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "password" => array( 'required', 'regex:/^[a-zA-Z]+\d*$/u')
                  ]);
            
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->all()], 400);
        }
        $user = User::where("id", $id)->update([
            "password" => Hash::make($request->password),
        ]);
        return response()->json(["user" => $user]);
    }

        
}
