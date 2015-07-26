<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	deleteCategoria();
	showEditCategoria();
	editCategoria();	
?>
<div class="text-center">
	<h2 class="text-center">Categorias</h2>
	<select onchange="showSeccionesCategorias(this.value)">
		<option>Seleccionar producto</option>
		<?php getProductosParaSelect(); ?>
	</select>
</div><hr>
<span id="seccionesCategorias">
</span>
<?php
	include 'includes/footer.php';
?>