<?php
	
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$bd = 'scraplife';
	
	define("HOST", "$server");
	define("USER", "$user");
	define("PASSWORD", "$pass");
	define("DATABASE", "$bd");
	 
	define("CAN_REGISTER", "any");
	define("DEFAULT_ROLE", "member");
	 
	define("SECURE", FALSE);    // ¡¡¡SOLO PARA DESARROLLAR!!!!
	
	function callDb(){		
		$db = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if(mysqli_connect_errno()){
			echo 'La conexion con la base de datos ha fallado con los siguientes errores: '. mysqli_connect_error();
			die();
		}
		$db->set_charset("utf8");
		
		return $db;
	}
	

	
?>