<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class PbiModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function identificador(){
		$sql = "SELECT identificador id FROM t_pbi WHERE codigo = (SELECT max(codigo) FROM t_pbi)";
		return $this->db->query($sql);
	}

	public function historias(){
		$sql = "SELECT codigo, identificador FROM t_historia";
		return $this->db->query($sql);
	}

	public function creaPbi($info, $info1, $info2, $info3, $info4){
		$sql = "INSERT INTO t_pbi
		(identificador, hiu_codigo, valor_negocio, esfuerzo, descripcion, spr_codigo, estado)
		VALUES 
		('{$info}', {$info1}, {$info2}, {$info3}, '{$info4}', 1, 'Nuevo')";
		return (mysqli_query($this->db, $sql));
	}

}
 ?>