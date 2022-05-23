<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class LoginModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function logIn($email){
		$email = $this->db->real_escape_string($email);
		$sql = "SELECT * FROM t_usuario WHERE email = '{$email}'";
		return $this->db->query($sql);
	}
}
 ?>