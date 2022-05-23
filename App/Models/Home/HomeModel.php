<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class HomeModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getUser($id)
	{
		return $this->db->query("SELECT * FROM `t_usuario` where `codigo` = $id")->fetch_array(MYSQLI_ASSOC);
	}
}