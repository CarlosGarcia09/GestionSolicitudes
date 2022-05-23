<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Activity/ActivityModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * 
 */
class ActivityController extends Controller
{
	
	
	private $model;
	private $session;
	
	public function __construct(){
		$this->model = new ActivityModel();	
		$this->session = new Session();
		$this->session->init();
		if($this->session->getStatus()==1 || empty($this->session->get('nombre')))
			header('location: '.FOLDER_PATH);
	}

	public function registrarActivity($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('Los campos con el *, son obligatorios ');
		$client = $this->model->registrarActivity($request_params['fecha_actividad'], $request_params['tiempo_actividad'], $request_params['persona'],$request_params['pbi'], $request_params['descripcion']);
		if ($client){
			echo '<script language="javascript">alert("Se ha registrado la actividad correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible registrar actividad");
		}
	}

	public function verify($request_params){
		return empty($request_params['fecha_actividad']) or empty($request_params['tiempo_actividad']) or empty($request_params['persona']) or empty($request_params['pbi']) or empty($request_params['descripcion']);
	}

	public function renderErrorMessage($message){
		$message = '<div class="alert alert-danger alert-dismissable"><strong>'.$message.'</strong></div>';
		$params = array('error_message' => $message);
		$this->render(__CLASS__, $params);
	}

	public function logout(){
		$this->session->close();
		header('location: '.FOLDER_PATH.'/Login');
	}

	public function exec(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$persona = $this->model->personas();
		$pbi = $this->model->pbi();
		$params = array('options' => $result,
			'persona' => $persona,
			'pbi' => $pbi,
			'nombre' => $this->session->get('nombre'));
		$this->render(__CLASS__, $params);
	}

}
?>