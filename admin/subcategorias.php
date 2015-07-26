<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';	
	deleteSubcategoria();
?>

<div class="text-center">
	<h2 class="text-center">Subcategorias</h2>
	<select onchange="showCategoriasEnSelect(this.value)">
		<option>Seleccionar producto</option>
		<?php getProductosParaSelect(); ?>
	</select>
	<select id="categoriasPorProducto" onchange="showSeccionSubcategorias(this.value)">
		<option>Seleccionar categoria</option>
	</select>
</div><hr>

	<span id="seccionSubcategorias">
	</span>
	
<?php
	include 'includes/footer.php';
?>