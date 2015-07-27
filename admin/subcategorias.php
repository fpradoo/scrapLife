<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';	
	deleteSubcategoria();
	getSelectsSubcategorias();
?>

<span id="seccionSubcategorias">
</span>
	
<?php
	botonAgregarSubcategoria();
	include 'includes/footer.php';
?>