<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class ProfileModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function infoUsuario($info){
		$sql = "SELECT codigo, tipo_identificacion, identificacion, nombre, apellido_1, apellido_2, sexo, fecha_nacimiento, email, telefono_celular FROM t_usuario  WHERE codigo = {$info}";
		return $this->db->query($sql);
	}

	public function profile($params, $usuario){
		$sql = "UPDATE t_usuario SET tipo_identificacion = '{$params['tipo_documento']}', identificacion = {$params['documento']}, nombre = '{$params['nombre']}', apellido_1 = '{$params['primer_apellido']}', apellido_2 = '{$params['segundo_apellido']}', sexo = '{$params['sexo']}', fecha_nacimiento = '{$params['fecha_nacimiento']}', email = '{$params['correo']}', telefono_celular = '{$params['telefono']}' WHERE codigo = {$usuario}";
		return $this->db->query($sql);
	}
}