<?php

namespace App\Http\Controllers;

use App\Aplication;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;

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

    public function logout(){
        \Session::put('options',null);
        return redirect()->route('logout');
    }

    public function apps(){
        $apps = \App\Aplication::all();
        return view('apps')->with('apps',$apps);
    }

    public function details($id){
        $app = \App\Aplication::find($id+0);

        $clients = DB::table('clients')
            ->join('clients_app', 'clients.id', '=', 'clients_app.clients_id')
            ->select('clients.*')
            ->where('aplication_id',$id+0)
            ->get();
        //$clients = DB::table('clients')->whereIn('id',$list)->get();

        return view('app_details')->with(['app' => $app,'clients' => $clients]);
    }

    public function add(Request $request){
        $list = \App\Aplication::all();
        $key = str_pad(count($list)+1,5,"0");
        $app = new Aplication();
        $app->name = $request->input('name');
        $app->uri = $request->input('url');
        $app->private_key = bcrypt('PRI'.$key);
        $app->public_key = bcrypt('PUB'.$key);
        $app->user_id = \Auth::user()->id;
        $app->save();

        return redirect()->route('apps.details',$app->id);
    }

    public function edit(Request $request){

        $app = \App\Aplication::find($request->input('id')+0);
        $app->name = $request->input('name');
        $app->uri = $request->input('url');
        $app->save();
        return redirect()->route('apps.details',$app->id);
    }

}
