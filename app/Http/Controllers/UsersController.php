<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function profile(){
        return view('users.edit');
    }
    public function getMyProfile(){
        $user = Auth::user();
        return response()->json(['user' => $user]);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => FALSE, "message" => "Campos incompletos"]);
        }
        else {
            $user = User::findOrFail($id);
            $user->name = $request->input("name");
            $user->email = $request->input("email");
            $user->password = bcrypt($request->input('password'));
            $user->update();
            $data = array(
                'user'       => $user,
                'success'       => TRUE,
                'message'       => 'Usario actualizado de manera correcta'
            );
            return response()->json($data);
        }
    }
}
