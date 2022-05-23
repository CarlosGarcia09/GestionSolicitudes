<?php
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Signin/SigninModel.php';
require_once LIBS_ROUTE.'Session.php';
/**
 * 
 */
class SigninController extends Controller{

	private $model;
	private $session;

	public function __construct()
	{
		$this->model = new SigninModel();
		$this->session = new Session();		
		$this->session->init();
		if($this->session->getStatus()==1 || empty($this->session->get('nombre')))
			header('location: '.FOLDER_PATH);
	}

	public function exec(){
		$result = $this->model->tipos_usuario();		
		$resultMenu = $this->model->menu($this->session->get('codigo_interno'));
		$params = array('options' => $resultMenu,
			'tipo_usuario' => $result);
		$this->render(__CLASS__, $params);
	}

	public function signin($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('Los campos con el *, son obligatorios');

		if ($this->verifyPassword($request_params))
			return $this->renderErrorMessage('Las contraseñas no coinciden');

		if (empty($request_params['tipo_usuario']))
			$request_params['tipo_usuario'] = 1;
		unset($request_params['valida_password']);
		$request_params['password'] = password_hash($request_params['password'], PASSWORD_DEFAULT);
		$client = $this->model->signin($request_params);
		if ($client){
			if($this->session->getStatus()==2 && !empty($this->session->get('nombre')))
				echo '<script language="javascript">alert("Se ha registrado correctamente");
				window.location.href= "'.FOLDER_PATH.'/Main"</script>';
			echo '<script language="javascript">alert("Se ha registrado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Login"</script>';
		} else {
			return $this->renderErrorMessage("Imposible registrar usuario");
		}
	}

	public function renderErrorMessage($message){
		$message = '<div class="alert alert-danger alert-dismissable"><strong>'.$message.'</strong></div>';
		$params = array('error_message' => $message);
		$this->render(__CLASS__, $params);
	}

	public function verify($request_params){
		return empty($request_params['nombre']) or empty($request_params['primer_apellido']) or
		empty($request_params['tipo_documento']) or empty($request_params['documento']) or 
		empty($request_params['telefono']) or empty($request_params['correo']) or 
		empty($request_params['sexo']) or empty($request_params['fecha_nacimiento']) or
		empty($request_params['password']) or empty($request_params['valida_password']);
	}

	public function verifyPassword($request_params){
		return $request_params['password'] <> $request_params['valida_password'];
	}

}

 ?>