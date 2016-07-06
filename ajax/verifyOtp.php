<?php
require_once './libotp.php';

$pubKey = '$2y$10$cj4qVmUIaKFU7mfl0XeTruwQLKF05iJSrrnMqQhNRj8/0kAKNajs6';
$priKey = '$2y$10$YffYFR6g4FCTnRRiwfQs0.dG7xIBb8ds6IqQn3BWRnQoU3C2Oo2Fi';
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