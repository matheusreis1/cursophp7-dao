<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class_name){

	$fileName = "class" .DIRECTORY_SEPARATOR.$class_name. ".php";

	if(file_exists($fileName)){
		require_once($fileName);
	}

});

 ?>