<?php defined('BASEPATH') or exit('No se permite acceso directo'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Main</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Gestión de solicitudes</a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menú <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              while ($valores = mysqli_fetch_array($client)) {
                echo '<li><a href="'.$valores['href'].'">'.$valores['nombre'].'</a>';
              }
            ?>
          </ul>
        </li>
      </ul>

    </div>
  </nav>

  <div class="container">
    
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container text-center">
        <h1>Bienvenvido <?= $nombre ?></h1>
        <p>¿En qué te podemos ayudar?</p>
        <div class="btn-group btn-group-justified">
          <?php
          $count = 1;
          echo '<div class="form-group row">';
          while ($valores = mysqli_fetch_array($opciones)) {
            echo '<div class="col-sm-4"><a href="'.$valores['href'].'" role="button" class="btn btn-primary" style="width:100%;">'.$valores['nombre'].'</a></div>';
            $count = $count+ 1;
            if ($count==4) {
              echo '</div><div class="form-group row">';
              $count = 1;
            }
          }
          echo '</div>';
          ?>
        </div>
      </div>
    </div>

  </div>

  <!-- Jquery  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>