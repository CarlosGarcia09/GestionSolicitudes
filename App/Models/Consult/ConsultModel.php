<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
/**
 * 
 */
class ConsultModel extends Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function consultaPbi(){
		$sql = "SELECT pbi.codigo, pbi.identificador, hiu.identificador hiu, pbi.descripcion, pbi.estado, case when pbi.spr_codigo = 1 then 'Sin definir' else spr.identificador end as spr, pbi.esfuerzo, pbi.valor_negocio FROM t_pbi pbi, t_sprint spr, t_historia hiu WHERE pbi.spr_codigo = spr.codigo and pbi.hiu_codigo = hiu.codigo order by pbi.valor_negocio desc";
		return $this->db->query($sql);
	}

	public function consultaHU(){
		$sql = "SELECT codigo, identificador, descripcion FROM t_historia";
		return $this->db->query($sql);
	}

	public function consultaSPR(){
		$sql = "SELECT codigo, identificador, descripcion, duracion FROM t_sprint where codigo <> 1";
		return $this->db->query($sql);
	}

	public function consultaActivity(){
		$sql = "SELECT act.codigo, act.fecha, act.horas, act.descripcion, usu.identificacion, pbi.identificador FROM t_usuario usu, t_pbi pbi, t_actividad act WHERE act.id_usu = usu.codigo AND act.id_pbi = pbi.codigo";
		return $this->db->query($sql);
	}

	public function consultaPersonas(){
		$sql = "SELECT codigo, identificacion FROM t_usuario";
		return $this->db->query($sql);
	}

	public function consultaPbiDetallada($parametro){
		$sql = "SELECT pbi.codigo, pbi.identificador, hiu.identificador hiu, pbi.descripcion, pbi.estado, case when pbi.spr_codigo = 1 then 'Sin definir' else spr.identificador end as spr, pbi.esfuerzo, pbi.valor_negocio, pbi.spr_codigo FROM t_pbi pbi, t_sprint spr, t_historia hiu WHERE pbi.spr_codigo = spr.codigo and pbi.hiu_codigo = hiu.codigo and pbi.codigo = {$parametro}";
		return $this->db->query($sql);
	}

	public function consultaHuDetallada($parametro){
		$sql = "SELECT codigo, identificador, descripcion FROM t_historia WHERE codigo = {$parametro}";
		return $this->db->query($sql);
	}

	public function consultaActivityDetallada($parametro){
		$sql = "SELECT act.codigo, act.fecha fecha, act.horas horas, act.descripcion descripcion, usu.identificacion persona, pbi.identificador pbi_identificador, usu.codigo usu_codigo, pbi.codigo pbi_codigo FROM t_usuario usu, t_pbi pbi, t_actividad act WHERE act.id_usu = usu.codigo AND act.id_pbi = pbi.codigo and act.codigo = {$parametro}";
		return $this->db->query($sql);
	}

	public function consultaSprDetallada($parametro){
		$sql = "SELECT codigo, identificador, descripcion, duracion FROM t_sprint WHERE codigo = {$parametro}";
		return $this->db->query($sql);
	}

	public function consultaSprint(){
		$sql = "SELECT codigo, case when identificador = '0' then 'Seleccione...' else identificador end as ide from t_sprint";
		return $this->db->query($sql);
	}

	public function tiempoSprint($params){
		$sql = "SELECT case when sum(pbi.esfuerzo) is null THEN 0 else sum(pbi.esfuerzo) end total, spr.duracion FROM t_pbi pbi, t_sprint spr WHERE pbi.spr_codigo = spr.codigo AND pbi.spr_codigo = {$params}";
		return $this->db->query($sql);
	}

	public function updatePbi($params){
		$sql = "UPDATE t_pbi set esfuerzo = {$params['esfuerzo']}, valor_negocio = {$params['valor_negocio']}, estado = '{$params['estado']}', spr_codigo = {$params['sprint']}, descripcion = '{$params['descripcion']}' where codigo = {$params['codigo_pbi']}";
		return $this->db->query($sql);
	}

	public function updateHu($params){
		$sql = "UPDATE t_historia set descripcion = '{$params['descripcion']}' where codigo = {$params['codigo_hu']}";
		return $this->db->query($sql);
	}

	public function updateSpr($params){
		$sql = "UPDATE t_sprint set descripcion = '{$params['descripcion']}', duracion = {$params['duracion']} where codigo = {$params['codigo_spr']}";
		return $this->db->query($sql);
	}

	public function updateActivity($params){
		$sql = "UPDATE t_actividad set fecha = '{$params['fecha']}', horas = {$params['horas']}, descripcion = '{$params['descripcion']}', id_usu = {$params['persona']}, id_pbi = {$params['pbi']} where codigo = {$params['codigo_activity']}";
		return $this->db->query($sql);
	}

	public function tipoUsuario($params){
		$sql = "SELECT codigo, tiu_codigo from t_usuario";
		return $this->db->query($sql);
	}

}
 ?>