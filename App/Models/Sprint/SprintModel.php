<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class SprintModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function identificador(){
		$sql = "SELECT identificador id FROM t_sprint WHERE codigo = (SELECT max(codigo) FROM t_sprint)";
		return $this->db->query($sql);
	}

	public function creaSprint($info, $info1, $info2){
		$sql = "INSERT INTO t_sprint
		(identificador, descripcion, duracion)
		VALUES 
		('{$info}', '{$info1}', {$info2})";
		return (mysqli_query($this->db, $sql));
	}

}
 ?>