<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class AppController extends Controller
{
    public function home(){
        if(\Auth::user()->role == 'root'){
            if(!session()->has('options')){
                $options = array(
                    array(
                        'route' => 'users',
                        'option' => 'Usuarios'
                    ),
                    array(
                        'route' => 'apps',
                        'option' => 'Aplicaciones'
                    )

                );
                \Session::put('options',$options);
            }
            $users = User::all()->where('role','owner');
            return view('users')->with('users',$users);
        }else{
            if(!session()->has('options')){
                $options = array(
                    array(
                        'route' => 'apps',
                        'option' => 'Aplicaciones'
                    )
                );
                \Session::put('options',$options);
            }
            $apps = \App\Aplication::all()->where('user_id',\Auth::user()->id+0);
            return view('apps')->with('apps',$apps);
        }

    }


    public function apps(){

        return view('apps');
    }

    public function logout(){
        \Session::put('options',null);
        return redirect()->route('logout');
    }
}
