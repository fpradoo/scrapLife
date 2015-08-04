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
		$db->set_charset("utf8");
		
		return $db;
	}
	
?>