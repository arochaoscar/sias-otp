<?php
require_once './libotp.php';

$pubKey = '$2y$10$WE7sWnlZuEx0hqXIYHvXVOFmFf1dEyR1TiXtDQ/7o15TREACxIEQ.';

$objOTP = new OTP();

$response = $objOTP->getOTP($pubKey,$_POST['email']);

echo $response;

