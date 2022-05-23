<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class PasswordModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function password($codigo){
		$sql = "SELECT codigo, password FROM t_usuario WHERE codigo = {$codigo}";
		return $this->db->query($sql);
	}

	public function updatePassword($pass, $usuario){
		$sql = "UPDATE t_usuario SET password = '{$pass}' WHERE codigo = {$usuario}";
		return $this->db->query($sql);
	}
}
 ?>