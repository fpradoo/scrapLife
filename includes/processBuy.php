<?php
	require_once ($_SERVER['DOCUMENT_ROOT']."/mp/lib/mercadopago.php");

	$mp = new MP ("8992299227915757", "mKhyUgOgwVsrZLcPLNC6lWBelo7PIoQL");
	
	$access_token = $mp->get_access_token();

	print_r ($access_token);
?>