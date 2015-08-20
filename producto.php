<?php 
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/navigation.php");

	getSeccionProductos();
	getSeccionProductosById();
	armarCarrito();
	deleteSession();
	deleteItem();
	addItem();
	include_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php");
?>