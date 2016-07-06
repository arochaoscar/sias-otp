<?php
session_start();
require_once './ajax/libotp.php';
$objOTP = new OTP();
$pubKey = '$2y$10$wZIE0gfigESV5XcnLnrmeO3cB27y5eY0ZIaOnL6.xnmz3tc8YrQi6 ';
$response = json_encode($objOTP->closeOTP($pubKey,$_SESSION['token']),1);
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login con OTP</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Login - OTP</a>
                </div>
            </div>
        </nav>        
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="alert alert-info">
                        <strong>Salida del Sistema:</strong> Sessión Finalizada
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="./" class="btn btn-primary">
                            <i class="glyphicon glyphicon-repeat"></i> Volver al Login
                        </a>
                    </div>    
                </div>
            </div>
        </div>
    </body>
</html>


