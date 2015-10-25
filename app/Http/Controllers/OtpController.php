<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Aplication;
use \App\Client;
use DB;
use anlutro\cURL\cURL;

class OtpController extends Controller
{
    public function getOTP(Request $request,$mail){


        if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $key = $request->headers->get('pub-key');
            $app = \App\Aplication::where('public_key', $key)->get();
            //return var_dump($app[0]->id);
            if(isset($app[0])){
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
                    $client = \App\Client::where('email',$mail)->get();
                    if(isset($client[0])){
                        $otp = str_random(8);
                        $curl = new cURL();
                        $url = 'http://desarrollo.ssas.gob.ve/rest/SMS?telf='.$client[0]->phone;
                        $url.= '&texto=Hemos eviado una clave de acceso temporal para la aplicación: '.$app[0]->name;
                        $url.= ' Su clave temporal OTP es: '.$otp;
                        $url.= '&app_name=ssas';
                        $curl->get($url);
                        $encrypt = crypt($otp,$app[0]->private_key);
                        return array('crypt'=>$encrypt);
                    }
                }
                return true;
            }else{
                return response()->json(['error' => 'unauthorized' ], 401);
            }

        }else{

        }
    }
}
