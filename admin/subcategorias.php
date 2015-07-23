<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';	
?>

<div class="text-center">
	<h2 class="text-center">Subcategorias</h2>
	<select>
		<option>Seleccionar producto</option>
		<?php getProductosParaSelect(); ?>
	</select>
	<select>
		<option>Seleccionar categoria</option>
	</select>
</div><hr>
<table class="table table-bordered table-striped table-auto">
	<thead>
		<th>
		</th>
		<th>
		Subcategorias
		</th>
		<th>
		</th>
	</thead>
	<tbody>
		<?php getSubcategoriasPorCategoria(); ?>
	</tbody>
</table><hr>
<?php
	include 'includes/footer.php';
?>