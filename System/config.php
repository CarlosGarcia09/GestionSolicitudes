<?php 
defined('BASEPATH') or exit ('No se permite el acceso directo');
/****************************************
VALORES URI
****************************************/
define('URI', $_SERVER['REQUEST_URI']);

/****************************************
VALORES CORE
****************************************/
define('CORE', 'System/Core/');
define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

/****************************************
VALORES RUTAS
****************************************/
define('FOLDER_PATH', '/ProductBacklog');
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PATH_VIEWS', FOLDER_PATH.'/App/Views/');
define('PATH_CONTROLLERS', 'App/Controllers/');
define('HELPER_PATH', 'System/helpers/');
define('DEFAULT_CONTROLLER', 'Home');
define('LIBS_ROUTE', 'System/Libs/');

/****************************************
VALORES BASE DE DATOS
****************************************/
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'productbacklog');

/****************************************
VALORES DE CONFIGURACIÓN
****************************************/
define('ERROR_REPORTING_LEVEL', -1);

/****************************************
OTROS VALORES
****************************************/
define('TITLE', 'SISTEMA PARA EL CONTROL DE SOLICITUDES (Product Backlog)');