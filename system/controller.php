<?php

class Controller {
	
	public function loadModel($name)
	{
		require(APP_DIR .'models/'. strtolower($name) .'.php');

		$name = explode('/', $name);
		$model_name = end($name);

		$model = new $model_name;
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function redirect($loc)
	{
		global $config;
		//echo $loc;
		
		header('Location: '. $config['base_url'] . $loc);
	}
    
}

?>