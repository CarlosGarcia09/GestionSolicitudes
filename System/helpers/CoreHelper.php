<?php 
defined('BASEPATH') or exit ('No se permite el acceso directo');
/**
 * 
 */
class CoreHelper
{
	
	public static function validateController($controller){
		if(!is_file(PATH_CONTROLLERS."{$controller}/{$controller}Controller.php"))
			return false;
		return true;
	}

	public static function validateMethodController($controller, $method){
		if(!method_exists($controller, $method))
			return false;
		return true;
	}
}