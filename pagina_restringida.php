<?php
session_start();
require_once './ajax/libotp.php';

$objOTP = new OTP();
$pubKey = '$2y$10$WE7sWnlZuEx0hqXIYHvXVOFmFf1dEyR1TiXtDQ/7o15TREACxIEQ.';


$response = json_decode($objOTP->verifySesion($pubKey,$_SESSION['token']),1);
if(!$response['access']){
    header("Location: error_acceso.php");
}
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
                    <div class="alert alert-success">
                        <strong>Acceso Permitido:</strong> Credenciales válidas 
                    </div>
                    <hr>
                    <div class="text-center">
                        <a href="./" class="btn btn-primary">
                            <i class="glyphicon glyphicon-off"></i> Cerrar Sesión
                        </a>
                    </div>    
                </div>
            </div>
        </div>
    </body>
</html>

