<?php defined('BASEPATH') or exit('No se permite acceso directo'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
 	<nav class="navbar navbar-default">
	    <div class="container">
	      <div class="navbar-header">
	        <a class="navbar-brand" href="#">SISTEMA PARA EL CONTROL DE SOLICITUDES (Product Backlog)</a>
	      </div>
	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	        	<!--<a href="/ProductBacklog/Home/signin" role="button"class="btn btn-primary">Registrarse</a>-->
	        	<a href="/ProductBacklog/Home/login" role="button" class="btn btn-success">Iniciar sesión</a>	          	
	        </li>
	      </ul>

	    </div>
  	</nav>
	 <div class="container">
    
	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <div class="jumbotron">
	      <div class="container text-center">
	        <h1>Bienvenido</h1>
	        <p>Recuerde que este es su sistema de gestión de solicitudes.<br>Para tener una cuenta, es necesario contactarse con el administrador del sistema ya que él es el único que puede crear otros usuarios.</p>
	      </div>
	    </div>

  </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>