<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	deleteCategoria();
	showEditCategoria();
	editCategoria();
	showAddCategoria();
    addCategoria();
	showSelectCategorias();	
?>

<span id="seccionesCategorias">
</span>

<?php
	botonAgregarCategoria();
	include 'includes/footer.php';
?>