<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
	sec_session_start();
 
	if (login_check($mysqli) == true) {
		$logged = 'in';
		require_once'../core/init.php';
		require_once'../admin/core/functions.php';
		include_once 'includes/head.php';
		include_once 'includes/navigation.php';
		//showEditProducto();
		deleteUsuario();
		//editProducto();
		getUsuarios();
		include 'includes/footer.php';
		
	} else {
		echo 'No está autorizado para acceder a esta página. Por favor, inicie su sesión';
	}
	
	
	
?>