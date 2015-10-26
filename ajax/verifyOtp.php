<?php
require_once './libotp.php';

$pubKey = '$2y$10$DMjHMXRe975V3WqI5XESke5P44lrsunofQfXVikczPLlAIrpCiTb6';
$priKey = '$2y$10$NhZ0VSjQ/ZJKfKHxm/FGBecEJSSdNCXeaOMNfczFJ6huBahuLzoMy';
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