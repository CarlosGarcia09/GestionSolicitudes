<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class ActivityModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function pbi(){
		$sql = "SELECT codigo, identificador FROM t_pbi";
		return $this->db->query($sql);
	}

	public function personas(){
		$sql = "SELECT codigo, identificacion FROM t_usuario";
		return $this->db->query($sql);
	}

	public function registrarActivity($info, $info1, $info2, $info3, $info4){
		$sql = "INSERT INTO t_actividad
		(fecha, horas, id_usu, id_pbi, descripcion)
		VALUES 
		('{$info}', {$info1}, {$info2}, {$info3}, '{$info4}')";
		return (mysqli_query($this->db, $sql));
	}

}
 ?>