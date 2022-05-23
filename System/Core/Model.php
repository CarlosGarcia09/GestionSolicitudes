<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class Model
{
	
	protected $db;

	public function __construct()
	{
		$this->db = new Mysqli(HOST, USER, PASSWORD, DATABASE);
	}

	public function menu($codigo_usuario){
		$codigo_usuario = $this->db->real_escape_string($codigo_usuario);
		$sql = "SELECT opc.nombre, opc.href FROM t_tipo_usuario tiu, t_opcion_tipo_usu otu, t_opcion opc, t_usuario usu WHERE otu.opc_codigo = opc.codigo AND otu.tiu_codigo = tiu.codigo AND usu.tiu_codigo = tiu.codigo AND usu.codigo = {$codigo_usuario} AND opc.visible = 'S' AND opc.menu = 'S' ORDER BY opc.orden";
		return $this->db->query($sql);
	}
}