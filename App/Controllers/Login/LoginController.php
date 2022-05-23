<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Login/LoginModel.php';
require_once LIBS_ROUTE.'Session.php';

class LoginController extends Controller
{
	private $model;
	private $session;

	public function __construct()
	{
		$this->model = new LoginModel();
		$this->session = new Session();
	}

	public function login($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('El email y password son obligatorios');

		$result = $this->model->logIn($request_params['email']);
		if (!$result->num_rows)
			return $this->renderErrorMessage("El email {$request_params['email']} no fue encontrado");

		$client = $result->fetch_object();
		if (!password_verify($request_params['password'], $client->password))
			return $this->renderErrorMessage("El password es incorrecto");

		$this->session->init();
		$this->session->add('nombre', $client->nombre);
		$this->session->add('codigo_interno', $client->codigo);
		$this->session->add('tipo_usuario', $client->tiu_codigo);
		$this->session->add('valida', 'OK');
		header('location: '.FOLDER_PATH.'/Main');
	}

	public function verify($request_params){
		return empty($request_params['email']) or empty($request_params['password']);
	}

	public function renderErrorMessage($message){
		$message = '<div class="alert alert-danger alert-dismissable"><strong>'.$message.'</strong></div>';
		$params = array('error_message' => $message);
		$this->render(__CLASS__, $params);
	}

	public function signin(){
		header('location: '.FOLDER_PATH.'/Signin');
	}

	public function exec(){
		$this-> render(__CLASS__);
	}

}

?>