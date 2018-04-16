<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\State;
class StatesController extends Controller
{
    public function index(){
        $states = State::all();
        foreach($states as $state){
            $state->municipalities;
        }
        return response()->json($states);
    }
}
