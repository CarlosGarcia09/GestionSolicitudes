<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class SigninModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function signin($params){
		$sql = "INSERT INTO t_usuario 
		(tipo_identificacion, identificacion, nombre, apellido_1, apellido_2, email, password, sexo, telefono_celular, fecha_nacimiento, tiu_codigo)
		VALUES 
		('{$params['tipo_documento']}', {$params['documento']}, '{$params['nombre']}', '{$params['primer_apellido']}', '{$params['segundo_apellido']}', '{$params['correo']}', '{$params['password']}', '{$params['sexo']}', {$params['telefono']}, '{$params['fecha_nacimiento']}', {$params['tipo_usuario']})";
		return (mysqli_query($this->db, $sql));
	}

	public function tipos_usuario(){
		$sql = "SELECT codigo, nombre FROM t_tipo_usuario";
		return $this->db->query($sql);
	}
}


 ?>