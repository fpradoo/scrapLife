<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	showEditProducto();
	showAddProducto();
	deleteProducto();
	addProducto();
	editProducto();		
?>
<hr>


<?php 
	getProductos();
	botonAgregarProducto();	
?>
	
<?php
	include 'includes/footer.php';
?>