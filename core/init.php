<?php
	
	function callDb(){
		$server = 'localhost';
		$user = 'root';
		$pass = '';
		$bd = 'scraplife';
		
		$db = mysqli_connect("$server","$user","$pass","$bd");
		if(mysqli_connect_errno()){
			echo 'La conexion con la base de datos ha fallado con los siguientes errores: '. mysqli_connect_error();
			die();
		}
		
		return $db;
	}
	
	require_once '../config.php';
	require_once BASEURL.'/helpers/helpers.php';
?>