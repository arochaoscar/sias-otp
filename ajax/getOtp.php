<?php
require_once './libotp.php';

$pubKey = '$2y$10$cj4qVmUIaKFU7mfl0XeTruwQLKF05iJSrrnMqQhNRj8/0kAKNajs6';

$objOTP = new OTP();

$response = $objOTP->getOTP($pubKey,$_POST['email']);

echo $response;

