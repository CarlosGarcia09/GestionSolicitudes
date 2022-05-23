<?php defined('BASEPATH') or exit('No se permite acceso directo'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Consult</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style type="text/css">
      .form-horizontal {
        width: 75%;
        margin: 0 auto;
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
      }      
      .text-center{
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        justify-content: center;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
      a.disabled {
        pointer-events: none;
        cursor: default;
      }
  </style>
</head>
<body>

  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="/ProductBacklog/Main/">ProductBacklog</a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menú <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
              while ($valores = mysqli_fetch_array($options)) {
                echo '<li><a href="'.$valores['href'].'">'.$valores['nombre'].'</a>';
              }
            ?>
          </ul>
        </li>
      </ul>

    </div>
  </nav>
  <div class="text-center container">
    <div class="form-horizontal">
      <?php !empty($table) ? print($table) : '';?> 
    </div>
  </div>
  <?php !empty($info) ? print($info) : '';?> 
  <!-- Jquery  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>