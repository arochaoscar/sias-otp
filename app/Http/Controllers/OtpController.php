<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Aplication;
use \App\Client;
use \App\Otp;
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
                $client = \App\Client::where('email',$mail)->get();
                if(isset($client[0])){
                    $list = ['libertad','patria','soberano','independencia','avanzadora','chavez','cimarron','cacao'];
                    $code = $list[rand(0,count($list)-1)].rand(100,999);
                    /* Solicitar envio de SMS */
                    $curl = new cURL();
                    $params = array(
                        'telf' => $client[0]->phone,
                        'texto' => 'Hemos eviado una clave de acceso temporal para la aplicación: '.$app[0]->name.' Su clave temporal OTP es: '.$code,
                        'app_name' => 'ssas'
                    );
                    $url = $curl->buildUrl('http://desarrollo.ssas.gob.ve/rest/SMS', $params);
                    $curl->get($url);

                    /* Solicitar envio de Correo */
                    $email = $client[0]->email;
                    \Mail::send('otp_mail', ['aplication' => $app[0]->name, 'otp' => $code  ],
                        function ($message) use ($email) {
                            $message->from('aplicaciones@gmail.com', 'Aplicaciones SIAS');
                            $message->to($email);
                            $message->subject('Clave de Acceso Temporal');
                        });
                    /* Encriptamos el otp con clave privada */
                    $encrypt = crypt($code,$app[0]->private_key);

                    /* Almacenamos OTP */
                    $otp = new Otp();
                    $otp->code = $encrypt;
                    $otp->status = 'D';
                    $otp->clients_id = $client[0]->id;
                    $otp->aplication_id = $app[0]->id;
                    $otp->save();

                    return array('crypt'=>$encrypt);
                }else{
                    return response()->json(['error' => 'no autorizado' ], 401);
                }
            }else{
                return response()->json(['error' => 'no autorizado' ], 401);
            }
        }else{
            return response()->json(['error' => 'no autorizado' ], 401);
        }

    }

    public function verifyOTP(Request $request,$code,$ip){
        $key = $request->headers->get('pub-key');
        $app = \App\Aplication::where('public_key', $key)->get();
        if(isset($app[0])){
            $encrypt = crypt($code,$app[0]->private_key);
            $otp = \App\Otp::where('code',$encrypt)->get();
            if(isset($otp[0])){
                if($otp[0]->status == 'D'){
                    $otp[0]->status = 'U';
                    $otp[0]->ip = $ip;
                    $otp[0]->save();
                    return array('response'=>true);
                }else{
                    return array('response'=>false);
                }
            }else{
                return array('response'=>false);
            }
        }else{
            return response()->json(['response' => 'no autorizado' ], 401);
        }
    }

    public function verifySession(Request $request,$code,$ip){
        $key = $request->headers->get('pub-key');
        $app = \App\Aplication::where('public_key', $key)->get();
        if(isset($app[0])){
            $encrypt = crypt($code,$app[0]->private_key);
            $otp = \App\Otp::where('code',$encrypt)->get();
            if(isset($otp[0])){
                if($otp[0]->status == 'U' AND $otp[0]->ip == $ip){
                    return array('access'=>true);
                }else{
                    return array('access'=>false);
                }
            }else{
                return array('access'=>false);
            }
        }else{
            return response()->json(['response' => 'no autorizado' ], 401);
        }
    }

    public function closeOTP(Request $request,$code,$ip){
        $key = $request->headers->get('pub-key');
        $app = \App\Aplication::where('public_key', $key)->get();
        if(isset($app[0])){
            $encrypt = crypt($code,$app[0]->private_key);
            $otp = \App\Otp::where('code',$encrypt)->get();
            if(isset($otp[0])){
                if($otp[0]->status == 'U' AND $otp[0]->ip == $ip){
                    $otp[0]->status = 'N';
                    $otp[0]->save();
                    return array('response'=>true);
                }else{
                    return array('response'=>false);
                }
            }else{
                return array('response'=>false);
            }
        }else{
            return response()->json(['response' => 'no autorizado' ], 401);
        }
    }

}
