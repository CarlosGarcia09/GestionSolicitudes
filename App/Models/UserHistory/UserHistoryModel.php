<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class UserHistoryModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function identificador(){
		$sql = "SELECT identificador id FROM t_historia WHERE codigo = (SELECT max(codigo) FROM t_historia)";
		return $this->db->query($sql);
	}

	public function creaHistoria($info, $info1){
		$sql = "INSERT INTO t_historia
		(identificador, descripcion)
		VALUES 
		('{$info}', '{$info1}')";
		return (mysqli_query($this->db, $sql));
	}

}
 ?>