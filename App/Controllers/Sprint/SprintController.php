<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Sprint/SprintModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * 
 */
class SprintController extends Controller
{

	private $model;
	private $session;
	
	public function __construct(){
		$this->model = new SprintModel();	
		$this->session = new Session();
		$this->session->init();
		if($this->session->getStatus()==1 || empty($this->session->get('nombre')))
			header('location: '.FOLDER_PATH);
	}

	public function creaSprint($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('Los campos con el *, son obligatorios');
		$client = $this->model->creaSprint($request_params['id'], $request_params['descripcion'], $request_params['duracion']);
		if ($client){
			echo '<script language="javascript">alert("Se ha registrado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible crear sprint");
		}
	}

	public function verify($request_params){
		return empty($request_params['id']) or empty($request_params['duracion']) or empty($request_params['descripcion']);
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
		$identificador = $this->model->identificador();
		$identificador = $identificador->fetch_object();
		$idHistory = substr($identificador->id, 4)+1;
		$params = array('options' => $result, 
			'nombre' => $this->session->get('nombre'), 
			'id' => 'SPR-'.$idHistory);
		$this->render(__CLASS__, $params);
	}

}


 ?>