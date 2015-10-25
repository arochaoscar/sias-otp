<?php

class OTP {
    /* Constructor Inicial */
    public function __construct() {
    }

    public function getOTP($pubkey,$mail) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://otpapp.org/api/otp/get/".$mail,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "pub-key: ".$pubkey
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            return array('crypt' => false);
        } else {
            //$otp = json_decode($response,1);
            return $response;//$otp['crypt'];
        }
    }
    
    /* Función para Verificar si el token*/
    public function verifyOTP($pubkey, $otp) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://otpapp.org/api/otp/verify/".$otp,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "pub-key: ".$pubkey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
    
    public function verifySesion($pubkey,$code) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://otpapp.org/api/otp/session/".$code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "pub-key: ".$pubkey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }   
    
    public function closeOTP($pubkey,$code){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://otpapp.org/api/otp/close/".$code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "pub-key: ".$pubkey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }        
    }
    
    public function cryptOTP($otp,$priKey){
        return  crypt($otp,$priKey);
    }

}
