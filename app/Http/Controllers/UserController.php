<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Aplication;

class UserController extends Controller
{

    public function users(){
        $users = User::all()->where('role','owner');
        return view('users')->with('users',$users);
    }

    public function details($id){
        $user = \App\User::find($id);
        $apps = \App\Aplication::all()->where('user_id',$id+0);
        //$apps =array();
        return view('user_details')->with(['user' => $user, 'apps' => $apps]);
    }

    public function edit(Request $request,$id){
        $user = \App\User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        //$user->role = 'owner';
        $user->save();
        return redirect()->route('home');
    }

    public function add(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt('Clave.123');
        $user->role = 'owner';
        $user->save();
        return redirect()->route('home');
    }

}
