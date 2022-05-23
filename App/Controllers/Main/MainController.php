<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Main/MainModel.php';
require_once LIBS_ROUTE.'Session.php';

/**
 * 
 */
class MainController extends Controller
{

	private $model;
	private $session;
	
	public function __construct(){
		$this->model = new MainModel();
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
		$result2 = $this->model->opciones($this->session->get('codigo_interno'));
		$params = array('client' => $result, 
			'nombre' => $this->session->get('nombre'), 
			'opciones' => $result2);
		$this->render(__CLASS__, $params);
	}

}


 ?>