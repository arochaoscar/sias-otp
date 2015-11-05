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
        }else{
            $client = \App\Client::find($request->input('user_id')+0);
        }
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->save();

        $cte_app = DB::table('clients_app')->insertGetId([
            'clients_id' => $client->id,
            'aplication_id' => $request->input('app_id'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);

        return redirect()->route('apps.details',$request->input('app_id'));

    }

    public function del($client,$app){
        DB::table('otps')->where('clients_id', $client)->delete();
        DB::table('clients_app')->where('clients_id', $client)->delete();
        DB::table('clients')->where('id', $client)->delete();
        return redirect()->route('apps.details',$app);
    }

    public function get($client){
        $data = \App\Client::find($client);
        return view('client_details')->with(['client' => $data]);
    }

    public function edit(Request $request,$id){
        $client = \App\Client::find($id);
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->save();
        return redirect()->route('clients.details',$id);
    }


}
