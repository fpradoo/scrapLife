<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php';
	sec_session_start();
 
	if (login_check($mysqli) == true) {
		$logged = 'in';
		require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/admin/core/functions.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/head.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/navigation.php';
		//showEditProducto();
		deleteUsuario();
		//editProducto();
		getUsuarios();
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/footer.php';
		
	} else {
		echo 'No está autorizado para acceder a esta página. Por favor, inicie su sesión';
	}
	
	
	
?>