<?php defined('BASEPATH') or exit('No se permite acceso directo'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Signin</title>
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
	<div class="text-center">
	    <form class="form-horizontal" method="POST" action="<?= FOLDER_PATH.'/signin/signin' ?>">
        	<h1 class="h3 mb-3 ">Registro</h1>
			<div class="form-group row">
				<label class="col-sm-2 ">Nombre*</label>
				<div class="col-sm-10" >
					<input name="nombre" type="text" class="form-control" placeholder="Nombre">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Primer apellido*</label>
				<div class="col-sm-4">
					<input name="primer_apellido" type="text" class="form-control" placeholder="Primer apellido">
				</div>
				<label class="col-sm-2 ">Segundo apellido</label>
				<div class="col-sm-4">
					<input name="segundo_apellido"  type="text" class="form-control" placeholder="Segundo apellido">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Tipo documento*</label>
				<div class="col-sm-4">
					<select class="form-control" name="tipo_documento" >
						<option selected disabled>Seleccione...</option>
	  					<option value="CC">Cédula de ciudadanía</option>
	  					<option value="TI">Tarjeta de identidad</option>
	  					<option value="CE">Cédula de extranjería</option>
					</select>	
				</div>	
				<label class="col-sm-2 ">Documento*</label>
				<div class="col-sm-4">
					<input name="documento" type="number" class="form-control" placeholder="Número de documento">
				</div>	
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Teléfono*</label>
				<div class="col-sm-4">
					<input name="telefono" type="number" class="form-control" placeholder="Número de teléfono">
				</div>	
				<label class="col-sm-2 ">Correo electrónico*</label>
				<div class="col-sm-4">
					<input name="correo" type="email" class="form-control" placeholder="Correo electrónico">
				</div>	
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Fecha nacimiento*</label>
				<div class="col-sm-4">
					<input name="fecha_nacimiento" type="date" class="form-control" >
				</div>	
				<label class="col-sm-2 ">Sexo*</label>
				<div class="col-sm-4">
					<select class="form-control" name="sexo">
						<option selected disabled>Seleccione...</option>
	  					<option value = "F">Femenino</option>
	  					<option value = "M">Masculino</option>
	  					<option value = "O">Otro</option>
					</select>	
				</div>	
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Contraseña*</label>
				<div class="col-sm-4">
					<input name="password" type="Password" class="form-control" placeholder="Contraseña">
				</div>	
				<label class="col-sm-2 ">Valida contraseña*</label>
				<div class="col-sm-4">
					<input name="valida_password" type="Password" class="form-control" placeholder="Valida contraseña">
				</div>	
			</div>
			<div class="form-group row">  
	            <?php
	        		echo '<div class="col-sm-3"></div><label class="col-sm-2 ">Tipo de usuario*</label><div class="col-sm-4"><select class="form-control" name="tipo_usuario" ><option selected disabled>Seleccione...</option>';
	            	while ($valores = mysqli_fetch_array($tipo_usuario)) {
	                	echo '<option value = "'.$valores['codigo'].'">'.$valores['nombre'].'</option>';
	              	}
	              	echo '</select></div><div class="col-sm-3"></div>';
	        		
	            ?>			          
			</div>
          	<?php !empty($error_message) ? print($error_message) : '';?> 
			<div class="form-group row">  
				<div class="col-sm-5"></div>
				<div class="col-sm-2">
					<button class="btn btn-lg btn-success btn-block" type="submit">Enviar</button>
				</div>	
				<div class="col-sm-5"></div>
			</div>
		</form>
	</div>
  <!-- Jquery  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>