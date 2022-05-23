<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Consult/ConsultModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * 
 */
class ConsultController extends Controller
{

	private $model;
	private $session;
	
	public function __construct(){
		$this->model = new ConsultModel();	
		$this->session = new Session();
		$this->session->init();
		if($this->session->getStatus()==1 || empty($this->session->get('nombre')))
			header('location: '.FOLDER_PATH);
	}

	public function logout(){
		$this->session->close();
		header('location: '.FOLDER_PATH.'/Login');
	}

	public function exec(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$params = array('options' => $result, 
			'nombre' => $this->session->get('nombre'),
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function renderErrorMessage($message){
		$message = '<div class="alert alert-danger alert-dismissable"><strong>'.$message.'</strong></div>';
		$params = array('error_message' => $message);
		$this->render(__CLASS__, $params);
	}

	public function ConsultPBI(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaPbi();
		$message = '<h1 class="h3 mb-3 text-center">Product Backlog</h1><ul><li>El product backlog está organizado por el campo valor negocio (de mayor valor de negocio a menor).</li></ul><br><br>';
		$message .= '<table class="table table-hover table-condensed table-bordered"><thead align="center">
        <tr><th>Identificador</th><th>Historia usuario</th><th>Valor negocio</th><th>Esfuerzo</th><th>Descripción</th><th>Estado</th><th>Sprint</th><th>Operación</th></tr></thead><tbody>';
		while ($valores = mysqli_fetch_array($consulta)) {
	    	$message .= '<tr><td>'.$valores[1].'</td><td>'.$valores[2].'</td><td>'.$valores[7].'</td><td>'.$valores[6].'</td><td>'.$valores[3].'</td><td>'.$valores[4].'</td><td>'.$valores[5].'</td>';
	    	if ($this->session->get('tipo_usuario') != 2){ $message .=' <td>--</td></tr>';} else {$message .= '<td><a href="'.FOLDER_PATH.'/Consult/pbi/'.$valores[0].'" role="button"class="btn btn-primary">Modificar</a></td></tr>';}
	    }
	    $message .="</tbody></table>";
	    $params = array('options' => $result, 
			'nombre' => $this->session->get('nombre'),
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function ConsultHU(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaHU();
		$message = '<h1 class="h3 mb-3 text-center">Historias de usuario</h1><br>';
		$message .= '<table class="table table-hover table-condensed table-bordered"><thead align="center">
        <tr><th>Identificador</th><th>Historia usuario</th><th>Operación</th></tr></thead><tbody>';
		while ($valores = mysqli_fetch_array($consulta)) {
	    	$message .= '<tr><td>'.$valores[1].'</td><td>'.$valores[2].'</td>';
	    	if ($this->session->get('tipo_usuario') != 2){ $message .=' <td>--</td></tr>';} else {$message .= '<td><a href="'.FOLDER_PATH.'/Consult/hu/'.$valores[0].'" role="button"class="btn btn-primary">Modificar</a></td></tr>';}
	    }
	    $message .="</tbody></table>";
	    $params = array('options' => $result, 
			'nombre' => $this->session->get('nombre'),
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function ConsultSPR(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaSpr();
		$message = '<h1 class="h3 mb-3 text-center">Sprints</h1><ul><li>El campo duración de cada Sprint está dado en horas.</li></ul><br><br>';
		$message .= '<table class="table table-hover table-condensed table-bordered"><thead align="center">
        <tr><th>Identificador</th><th>Descripción</th><th>Duración</th><th>Operación</th></tr></thead><tbody>';
		while ($valores = mysqli_fetch_array($consulta)) {
	    	$message .= '<tr><td>'.$valores[1].'</td><td>'.$valores[2].'</td><td>'.$valores[3].'</td>';
	    	if ($this->session->get('tipo_usuario') != 2){ $message .=' <td>--</td></tr>';} else {$message .= '<td><a href="'.FOLDER_PATH.'/Consult/spr/'.$valores[0].'" role="button"class="btn btn-primary">Modificar</a></td></tr>';}
	    }
	    $message .="</tbody></table>";
	    $params = array('options' => $result, 
			'nombre' => $this->session->get('nombre'),
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function ConsultActivity(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaActivity();
		$message = '<h1 class="h3 mb-3 text-center">Actividades</h1><br><br>';
		$message .= '<table class="table table-hover table-condensed table-bordered"><thead align="center">
        <tr><th>Fecha</th><th>Tiempo</th><th>Descripción</th><th>Persona</th><th>PBI</th><th>Operación</th></tr></thead><tbody>';
		while ($valores = mysqli_fetch_array($consulta)) {
	    	$message .= '<tr><td>'.$valores[1].'</td><td>'.$valores[2].'</td><td>'.$valores[3].'</td></td><td>'.$valores[4].'</td></td><td>'.$valores[5].'</td><td><a href="'.FOLDER_PATH.'/Consult/Activity/'.$valores[0].'" role="button"class="btn btn-primary">Modificar</a></td></tr>';
	    }
	    $message .="</tbody></table>";
	    $params = array('options' => $result, 
			'nombre' => $this->session->get('nombre'),
			'table' => $message);
		$this->render(__CLASS__, $params);
	}


	public function pbi($codigo_pbi){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaPbiDetallada($codigo_pbi);
		$consulta = $consulta->fetch_object();
		$message = '<h1 class="h3 mb-3 text-center">Actualizar PBI</h1><form method="POST" action="'.FOLDER_PATH.'/consult/modificarPbi/">
		<div class="form-group row">

			<label class="col-sm-2 ">Identificador</label>
			<div class="col-sm-4">
				<input disabled class="form-control" value="'.$consulta->identificador.'" type="text">
			</div>
			<label class="col-sm-2 ">Historia Usuario</label>
			<div class="col-sm-4">
				<input disabled class="form-control" value="'.$consulta->hiu.'" type="text">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 ">Esfuerzo</label>
			<div class="col-sm-4">
				<input class="form-control" name="esfuerzo" value="'.$consulta->esfuerzo.'" type="number">
			</div>
			<label class="col-sm-2 ">Valor negocio</label>
			<div class="col-sm-4">
				<input class="form-control" name="valor_negocio" value="'.$consulta->valor_negocio.'" type="number">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 ">Estado</label>
			<div class="col-sm-4">
				<select class="form-control" name="estado" >';
					if ($consulta->estado == "Nuevo"){
						$message.= '<option selected value="Nuevo">Nuevo</option>';
					} else {
						$message.= '<option value="Nuevo">Nuevo</option>';
					}
					if ($consulta->estado == "En Proceso"){
						$message.= '<option selected value="En Proceso">En Proceso</option>';
					} else {
						$message.= '<option value="En Proceso">En Proceso</option>';
					}
					if ($consulta->estado == "Finalizado"){
						$message.= '<option selected value="Finalizado">Finalizado</option>';
					} else {
						$message.= '<option value="Finalizado">Finalizado</option>';
					}
				$message.= '</select>
			</div>
			<label class="col-sm-2 ">Sprint</label>
			<div class="col-sm-4">
				<select class="form-control" name="sprint" >';
				$consulta1 = $this->model->consultaSprint();
				while ($valores1 = mysqli_fetch_array($consulta1)) {
                	$message .= '<option ';
                	if($consulta->spr_codigo == $valores1['codigo']){$message .= ' selected ';}
                	$message .= ' value = "'.$valores1['codigo'].'">'.$valores1['ide'].'</option>';
              	}
              	$message = $message.'</select>

			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 ">Descripción</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="descripcion" rows="3" >'.$consulta->descripcion.'</textarea>
			</div>
		</div>		
		<div class="form-group row">
			<div class="col-sm-5"><input type="hidden" name="codigo_pbi" value="'.$codigo_pbi.'" ></div>
			<div class="col-sm-2">
				<button class="btn btn-success" type="submit">Enviar</button>
			</div>
			<div class="col-sm-5"></div>
		</div>
		</form>';
		$params = array('options' => $result, 
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function hu($codigo_hu){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaHuDetallada($codigo_hu);
		$consulta = $consulta->fetch_object();
		$message = '<h1 class="h3 mb-3 text-center">Actualizar PBI</h1><form method="POST" action="'.FOLDER_PATH.'/consult/modificarHu/">
		<div class="form-group row">

			<label class="col-sm-3 ">Identificador</label>
			<div class="col-sm-4">
				<input disabled class="form-control" value="'.$consulta->identificador.'" type="text">
			</div>
			
		</div>
		<div class="form-group row">
			<label class="col-sm-3 ">Descripción</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="descripcion" rows="3" >'.$consulta->descripcion.'</textarea>
			</div>
		</div>		
		<div class="form-group row">
			<div class="col-sm-5"><input type="hidden" name="codigo_hu" value="'.$codigo_hu.'" ></div>
			<div class="col-sm-2">
				<button class="btn btn-success" type="submit">Enviar</button>
			</div>
			<div class="col-sm-5"></div>
		</div>
		</form>';
		$params = array('options' => $result, 
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function spr($codigo_spr){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaSprDetallada($codigo_spr);
		$consulta = $consulta->fetch_object();
		$message = '<h1 class="h3 mb-3 text-center">Actualizar Sprint</h1><form method="POST" action="'.FOLDER_PATH.'/consult/modificarSpr/">
		<div class="form-group row">

			<label class="col-sm-2 ">Identificador</label>
			<div class="col-sm-4">
				<input disabled class="form-control" value="'.$consulta->identificador.'" type="text">
			</div>

			<label class="col-sm-2 ">Duración</label>
			<div class="col-sm-4">
				<input name ="duracion" class="form-control" value="'.$consulta->duracion.'" type="number">
			</div>
			
		</div>
		<div class="form-group row">
			<label class="col-sm-3 ">Descripción</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="descripcion" rows="3" >'.$consulta->descripcion.'</textarea>
			</div>
		</div>		
		<div class="form-group row">
			<div class="col-sm-5"><input type="hidden" name="codigo_spr" value="'.$codigo_spr.'" ></div>
			<div class="col-sm-2">
				<button class="btn btn-success" type="submit">Enviar</button>
			</div>
			<div class="col-sm-5"></div>
		</div>
		</form>';
		$params = array('options' => $result, 
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

public function activity($codigo_act){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$consulta = $this->model->consultaActivityDetallada($codigo_act);
		$consulta = $consulta->fetch_object();
		$message = '<h1 class="h3 mb-3 text-center">Actualizar Actividad</h1><form method="POST" action="'.FOLDER_PATH.'/consult/modificarActivity/">
		<div class="form-group row">

			<label class="col-sm-2 ">Fecha</label>
			<div class="col-sm-4">
				<input class="form-control" name="fecha" value="'.$consulta->fecha.'" type="date">
			</div>
			<label class="col-sm-2 ">Horas</label>
			<div class="col-sm-4">
				<input class="form-control" name="horas" step="any" value="'.$consulta->horas.'" type="number">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 ">Persona</label>
			<div class="col-sm-4">
				<select class="form-control" name="persona" >';
				$consulta1 = $this->model->consultaPersonas();
				while ($valores1 = mysqli_fetch_array($consulta1)) {
                	$message .= '<option ';
                	if($consulta->usu_codigo == $valores1['codigo']){$message .= ' selected ';}
                	$message .= ' value = "'.$valores1['codigo'].'">'.$valores1['identificacion'].'</option>';
              	}
              	$message = $message.'</select>
			</div>
			<label class="col-sm-2 ">PBI</label>
			<div class="col-sm-4">
				<select class="form-control" name="pbi" >';
				$consulta1 = $this->model->consultaPBI();
				while ($valores1 = mysqli_fetch_array($consulta1)) {
                	$message .= '<option ';
                	if($consulta->pbi_codigo == $valores1['codigo']){$message .= ' selected ';}
                	$message .= ' value = "'.$valores1['codigo'].'">'.$valores1['identificador'].'</option>';
              	}
              	$message = $message.'</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-3 ">Descripción</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="descripcion" rows="3" >'.$consulta->descripcion.'</textarea>
			</div>
		</div>		
		<div class="form-group row">
			<div class="col-sm-5"><input type="hidden" name="codigo_activity" value="'.$codigo_act.'" ></div>
			<div class="col-sm-2">
				<button class="btn btn-success" type="submit">Enviar</button>
			</div>
			<div class="col-sm-5"></div>
		</div>
		</form>';
		$params = array('options' => $result, 
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function modificarPbi($request_params){
		if ($request_params['sprint']==1 && $request_params['estado']!='Nuevo')
			echo '<script language="javascript">alert("No se puede realizar esta acción. Asigne un sprint para cambiar el estado del PBI");
			window.location.href= "'.FOLDER_PATH.'/Consult/pbi/'.$request_params['codigo_pbi'].'"</script>';

		if ($request_params['sprint']!= 1 && $request_params['estado']=='Nuevo')
			echo '<script language="javascript">alert("No se puede realizar esta acción. Cuando el estado es nuevo, no se pueden asociar Sprint");
			window.location.href= "'.FOLDER_PATH.'/Consult/pbi/'.$request_params['codigo_pbi'].'"</script>';

		$result = $this->model->updatePbi($request_params);
		if ($result){
			echo '<script language="javascript">alert("Se ha actualizado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible actualizar PBI");
		}
	}

	public function modificarHu($request_params){
		$result = $this->model->updateHu($request_params);
		if ($result){
			echo '<script language="javascript">alert("Se ha actualizado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {

			return $this->renderErrorMessage("Imposible actualizar historia");
		}
	}

	public function modificarSpr($request_params){
		$valida = $this->model->tiempoSprint($request_params['codigo_spr']);
		$valida = $valida->fetch_object();
		if ($valida->total>$request_params['duracion']) 
			echo '<script language="javascript">alert("No se puede realizar esta acción. Ya hay PBIs asociados a este Sprint, y su tiempo supera al que intenta fijar");
			window.location.href= "'.FOLDER_PATH.'/Consult/spr/'.$request_params['codigo_spr'].'"</script>';
		$result = $this->model->updateSpr($request_params);
		if ($result){
			echo '<script language="javascript">alert("Se ha actualizado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible actualizar Sprint");
		}
	}

	public function modificarActivity($request_params){
		$result = $this->model->updateActivity($request_params);
		if ($result){
			echo '<script language="javascript">alert("Se ha actualizado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible actualizar Actividad");
		}
	}

}


 ?>