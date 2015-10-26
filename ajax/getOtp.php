<?php
require_once './libotp.php';

$pubKey = '$2y$10$DMjHMXRe975V3WqI5XESke5P44lrsunofQfXVikczPLlAIrpCiTb6';

$objOTP = new OTP();

$response = $objOTP->getOTP($pubKey,$_POST['email']);

echo $response;

