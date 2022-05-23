<?php 
define('BASEPATH', true);

require('System/config.php');
require('System/Core/autoload.php');

error_reporting(ERROR_REPORTING_LEVEL);

$router = new Router();

$controlador = $router->getController();
$metodo = $router->getMethod();
$parametro = $router->getParam();

if(!CoreHelper::validateController($controlador))
	$controlador = 'ErrorPage';

require PATH_CONTROLLERS . "{$controlador}/{$controlador}Controller.php";

$controlador .= 'Controller';

if(!CoreHelper::validateMethodController($controlador, $metodo))
	$metodo = 'exec';

$controlador = new $controlador;
$controlador ->$metodo($parametro);