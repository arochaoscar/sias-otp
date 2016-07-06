<?php
session_unset();
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Inicio de Sesión con OTP</h4>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-danger" id="msjError" style="display: none"></div>
                            <form action="ajax/verifyOtp.php" method="POST">
                                <div class="form-group">
                                    <label for="email">Correo:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-envelope"></i>
                                        </div>
                                        <input type="email" class="form-control" id="email" placeholder="usuario@dominio.com">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary" id="btnOTP">
                                        <i class="glyphicon glyphicon-send"></i> Solicitar Clave Temporal
                                    </button>
                                </div>
                                <div class="progress" style="display: none" id="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        Enviando...
                                    </div>
                                </div>
                                <hr>
                                <div id="inOTP" style="display: none">
                                    <div class="form-group" >
                                        <label for="otp">OTP:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </div>                                        
                                            <input type="password" class="form-control" name="otp" id="otp" placeholder="Cave Temporal - OTP">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" >
                                            <i class="glyphicon glyphicon-user"></i> Autenticar
                                        </button>
                                    </div>                        
                                </div>    
                                <input type="hidden" name="crypt" id="crypt"/>
                            </form>
                        </div>    
                    </div>

                </div>
            </div>
        </div>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script>
            $(function(){
               var btnOTP = $('#btnOTP');
               var email = $('#email');
               var msjError = $('#msjError');
               var crypt = $('#crypt');
               var progress = $('#progress');
               var inOTP = $('#inOTP');
               btnOTP.click(function(){
                   crypt.val('');
                   inOTP.hide();                   
                   indSend = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.val());
                   if(indSend){
                        $.ajax({
                            url:'ajax/getOtp.php',
                            method: "POST",
                            data: {
                                email: email.val()
                            },
                            dataType: 'JSON',
                            beforeSend:function(){
                                progress.show();
                                btnOTP.hide();
                            },
                            complete:function(){
                                progress.hide();
                            },
                            success:function(r){
                                if(!r.crypt){
                                    msjError.text('Formato de Correo inválido');
                                    msjError.show();                                    
                                }else{
                                    crypt.val(r.crypt);
                                    inOTP.show();
                                }
                                btnOTP.html('<i class="glyphicon glyphicon-send"></i> Volver a Solicitar');
                                btnOTP.show();
                            }
                        });
                   }else{
                       msjError.text('Formato de Correo inválido');
                       msjError.show();
                   }
               });
               
               email.focus(function(){
                   msjError.hide();
               });
               
            });
        </script>
    </body>
</html>
