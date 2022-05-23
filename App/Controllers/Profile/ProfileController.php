<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Profile/ProfileModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * 
 */
class ProfileController extends Controller
{

	private $model;
	private $session;
	
	public function __construct(){
		$this->model = new ProfileModel();	
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
		$consulta = $this->model->infoUsuario($this->session->get('codigo_interno'));
		$consulta = $consulta->fetch_object();
		$message = '<form class="form-horizontal" method="POST" action="'.FOLDER_PATH.'/Profile/Profile">
			<h1 class="h3 mb-3 ">Mi perfil</h1>
			<div class="form-group row">
				<label class="col-sm-2 ">Nombre*</label>
				<div class="col-sm-10" >
					<input name="nombre" type="text" class="form-control" value="'.$consulta->nombre.'">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Primer apellido*</label>
				<div class="col-sm-4">
					<input name="primer_apellido" type="text" class="form-control" value="'.$consulta->apellido_1.'">
				</div>
				<label class="col-sm-2 ">Segundo apellido</label>
				<div class="col-sm-4">
					<input name="segundo_apellido"  type="text" class="form-control" value="'.$consulta->apellido_2.'">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Tipo documento*</label>
				<div class="col-sm-4">
					<select class="form-control" name="tipo_documento" >
						<option disabled>Seleccione...</option>';
						if ($consulta->tipo_identificacion == "CC"){
							$message.= '<option selected value="CC">Cédula de ciudadanía</option>';
						} else {
							$message.= '<option value="CC">Cédula de ciudadanía</option>';
						}
						if ($consulta->tipo_identificacion == "TI"){
							$message.= '<option selected value="TI">Tarjeta de identidad</option>';
						} else {
							$message.= '<option value="TI">Tarjeta de identidad</option>';
						}
						if ($consulta->tipo_identificacion == "CE"){
							$message.= '<option selected value="CE">Cédula de extranjería</option>';
						} else {
							$message.= '<option value="CE">Cédula de extranjería</option>';
						}
					$message .= '</select>	
				</div>	
				<label class="col-sm-2 ">Documento*</label>
				<div class="col-sm-4">
					<input name="documento" type="number" class="form-control" value="'.$consulta->identificacion.'">
				</div>	
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Teléfono*</label>
				<div class="col-sm-4">
					<input name="telefono" type="number" class="form-control" value="'.$consulta->telefono_celular.'">
				</div>	
				<label class="col-sm-2 ">Correo electrónico*</label>
				<div class="col-sm-4">
					<input name="correo" type="email" class="form-control" value="'.$consulta->email.'">
				</div>	
			</div>
			<div class="form-group row">
				<label class="col-sm-2 ">Fecha nacimiento*</label>
				<div class="col-sm-4">
					<input name="fecha_nacimiento" type="date" class="form-control" value="'.$consulta->fecha_nacimiento.'">
				</div>	
				<label class="col-sm-2 ">Sexo*</label>
				<div class="col-sm-4">
					<select class="form-control" name="sexo">
						<option disabled>Seleccione...</option>';
						if ($consulta->sexo == "F"){
							$message.= '<option selected value = "F">Femenino</option>';
						} else {
							$message.= '<option value = "F">Femenino</option>';
						}
						if ($consulta->sexo == "M"){
							$message.= '<option selected value = "M">Masculino</option>';
						} else {
							$message.= '<option value = "M">Masculino</option>';
						}
						if ($consulta->sexo == "O"){
							$message.= '<option selected value = "O">Otro</option>';
						} else {
							$message.= '<option value = "O">Otro</option>';
						}		
					$message .= '</select>
				</div>
			</div>
			<div class="form-group row">  
				<div class="col-sm-5"></div>
				<div class="col-sm-2">
					<button class="btn btn-lg btn-success btn-block" type="submit">Actualizar</button>
				</div>	
				<div class="col-sm-5"></div>
			</div></form>';
		$params = array('options' => $result, 
			'table' => $message);
		$this->render(__CLASS__, $params);
	}

	public function profile($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('Los campos con el *, son obligatorios');
		$client = $this->model->profile($request_params, $this->session->get('codigo_interno'));
		if ($client){
			echo '<script language="javascript">alert("Se ha actualizado la información correctamente");  window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible actualizar información");
		}
	}

	public function verify($request_params){
		return empty($request_params['nombre']) or empty($request_params['primer_apellido']) or
		empty($request_params['tipo_documento']) or empty($request_params['documento']) or 
		empty($request_params['telefono']) or empty($request_params['correo']) or 
		empty($request_params['sexo']) or empty($request_params['fecha_nacimiento']);
	}

	public function renderErrorMessage($message){
		$message = '<div class="alert alert-danger alert-dismissable"><strong>'.$message.'</strong></div>';
		$params = array('error_message' => $message);
		$this->render(__CLASS__, $params);
	}


}


 ?>