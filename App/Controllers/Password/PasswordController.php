<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Password/PasswordModel.php';
require_once LIBS_ROUTE.'Session.php';

class PasswordController extends Controller
{
	private $model;
	private $session;

	public function __construct()
	{
		$this->model = new PasswordModel();
		$this->session = new Session();
		$this->session->init();
		if($this->session->getStatus()==1 || empty($this->session->get('nombre')))
			header('location: '.FOLDER_PATH);
	}

	public function password($request_params){
		if ($this->verify($request_params))
			return $this->renderErrorMessage('Todos los campos son obligatorios');

		$result = $this->model->password($this->session->get('codigo_interno'));
		if (!$result->num_rows)
			return $this->renderErrorMessage("Imposible encontrar información del usuario");

		$client = $result->fetch_object();
		if (!password_verify($request_params['password_actual'], $client->password))
			return $this->renderErrorMessage("La contaseña actual ingresada es incorrecta");

		if ($this->verifyPassword($request_params))
			return $this->renderErrorMessage('Las nuevas contraseñas no coinciden');

		unset($request_params['password_valida']);
		$request_params['password_nueva'] = password_hash($request_params['password_nueva'], PASSWORD_DEFAULT);

		$client = $this->model->updatePassword($request_params['password_nueva'], $this->session->get('codigo_interno'));
		if ($client){
			echo '<script language="javascript">alert("Se ha actualizó la contaseña correctamente");
				window.location.href= "'.FOLDER_PATH.'/Main"</script>';;
		} else {
			return $this->renderErrorMessage("Imposible actualizar contraseña");
		}

	}

	public function logout(){
		$this->session->close();
		header('location: '.FOLDER_PATH.'/Login');
	}
	
	public function verify($request_params){
		return empty($request_params['password_actual']) or empty($request_params['password_nueva']) 
		or empty($request_params['password_valida']);
	}

	public function renderErrorMessage($message){
		$message = '<div class="alert alert-danger alert-dismissable"><strong>'.$message.'</strong></div>';
		$params = array('error_message' => $message);
		$this->render(__CLASS__, $params);
	}

	public function verifyPassword($request_params){
		return $request_params['password_nueva'] <> $request_params['password_valida'];
	}

	public function exec(){
		$result = $this->model->menu($this->session->get('codigo_interno'));
		$params = array('options' => $result);
		$this-> render(__CLASS__, $params);
	}

}

?>