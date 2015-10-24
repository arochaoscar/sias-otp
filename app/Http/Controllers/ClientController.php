<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use DB;

class ClientController extends Controller
{
    public function search($id){
        $clients = DB::table('clients')->where('name', 'iLIKE', '%'.$id.'%')->get();
        return json_encode($clients);
    }

    public function add(Request $request){
        if(!$request->input('user_id')){
            $client = new Client();
            $id = $client->id;
        }else{
            $id = $request->input('user_id');
            $client = \App\Client::find($id+0);
        }
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->save();

        $cte_app = DB::table('clients_app')->insertGetId([
            'clients_id' => $id,
            'aplication_id' => $request->input('app_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);

        return redirect()->route('apps.details',$request->input('app_id'));

    }

    public function del($client,$app){
        DB::table('clients_app')->where('clients_id', $client)->where('aplication_id',$app)->delete();

        return redirect()->route('apps.details',$app);
    }

}
