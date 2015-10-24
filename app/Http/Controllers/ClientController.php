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
}
