<?php 
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");
	getSeccionProductos();
	getSeccionProductosById();
	armarCarrito();
	deleteSession();
	include_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php");
?>