<?php 
defined('BASEPATH') or exit('No se permite acceso directo');
require_once ROOT.''.FOLDER_PATH.'/App/Models/Home/HomeModel.php';

/**
 * 
 */

class HomeController extends Controller
{
	public $model;
  	public $nombre;

	public function __construct()
	{
		$this->model = new HomeModel();
    	$this->nombre = 'Mundo';
	}

	public function login(){
		echo FOLDER_PATH.'/login';
		header('location: '.FOLDER_PATH.'/login');
	}

	public function signin(){
		echo FOLDER_PATH.'/signin';
		header('location: '.FOLDER_PATH.'/signin');
	}

	public function exec(){
		$this->render(__CLASS__);
	}

}