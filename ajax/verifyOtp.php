<?php
require_once './libotp.php';

$pubKey = '$2y$10$WE7sWnlZuEx0hqXIYHvXVOFmFf1dEyR1TiXtDQ/7o15TREACxIEQ.';
$priKey = '$2y$10$WEX/VhqhsudoTo/Ec3M6g.inaSD7sM.cdsTntmR/KWV5HuGgcoPsu';
$objOTP = new OTP();

if($_POST['crypt'] == $objOTP->cryptOTP($_POST['otp'], $priKey)){
    $response = json_decode($objOTP->verifyOTP($pubKey, $_POST['otp']),1);
    if($response['response']){
        session_start();
        $_SESSION['token']= $_POST['otp'];
        header("Location: ../pagina_restringida.php");
    }else{
        header("Location: ../error_acceso.php");   
    }
}else{
    header("Location: ../error_acceso.php");   
}