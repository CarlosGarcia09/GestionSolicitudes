<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Pbi/PbiModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * 
 */
class PbiController extends Controller
{
	
	
	private $model;
	private $session;
	
	public function __construct(){
		$this->model = new PbiModel();	
		$this->session = new Session();
		$this->session->init();
		if($this->session->getStatus()==1 || empty($this->session->get('nombre')))
			header('location: '.FOLDER_PATH);
	}

	public function creaPbi($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('Los campos con el *, son obligatorios');
		$client = $this->model->creaPbi($request_params['id'], $request_params['hu'], $request_params['vn'],$request_params['esfuerzo'], $request_params['descripcion']);
		if ($client){
			echo '<script language="javascript">alert("Se ha registrado correctamente");
			window.location.href= "'.FOLDER_PATH.'/Main"</script>';
		} else {
			return $this->renderErrorMessage("Imposible crear PBI");
		}
	}

	public function verify($request_params){
		return empty($request_params['id']) or empty($request_params['hu']);
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
		$hu = $this->model->historias();
		$params = array('options' => $result,
			'hu' => $hu,
			'nombre' => $this->session->get('nombre'), 
			'id' => 'PBI-'.$idHistory);
		$this->render(__CLASS__, $params);
	}

}
?>