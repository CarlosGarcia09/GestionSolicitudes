<?php defined('BASEPATH') or exit('No se permite acceso directo'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <style type="text/css">
      .text-center{
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-login {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-login .checkbox {
        font-weight: 400;
      }
      .form-login .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
      }
      .form-login .form-control:focus {
        z-index: 2;
      }
      .form-login input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }
      .form-login input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/ProductBacklog/">SISTEMA PARA EL CONTROL DE SOLICITUDES</a>
        </div>
      </div>
    </nav>
    <div class="text-center">
      <form class="form-login" method="POST" action="<?= FOLDER_PATH.'/login/login' ?>">
        <h1 class="h3 mb-3 ">Inicio de sesión</h1>
        <label for="inputEmail" class="sr-only">Correo electrónico</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Correo electrónico" autofocus="">
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" >
        <div class="checkbox mb-3">
          <?php !empty($error_message) ? print($error_message) : '';?>   
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Iniciar sesión</button>
        <!--<a href="/ips_sis/Home/signin" role="button" class="btn btn-lg btn-primary btn-block">Registrarme</a>-->
        <!--<p class="mt-5 mb-3 text-muted">Ágata software © 2020</p>-->
      </form>
    </div>
    
  

</body>
</html>