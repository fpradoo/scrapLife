<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	//changeCategoriaPorAjax();
		
?>
<div class="text-center">
	<h2 class="text-center">Categorias</h2>
	<select onchange="showCategorias(this.value)">
		<option>Seleccionar producto</option>
		<?php getProductosParaSelect(); ?>
	</select>
</div><hr>
<table class="table table-bordered table-striped table-auto">
	<thead>
		<th>
		</th>
		<th>
		Categorias seccion interna
		</th>
		<th>
		</th>
	</thead>
	<tbody id="categoriasInternas">
		<?php getCategoriaPorProductoInterno(); ?>
	</tbody>
</table><hr>
<table class="table table-bordered table-striped table-auto">
	<thead>
		<th>
		</th>
		<th>
		Categoria seccion externa
		</th>
		<th>
		</th>
	</thead>
	<tbody>
		<?php getCategoriaPorProductoExterno(); ?>
	</tbody>
</table><hr>
<?php
	include 'includes/footer.php';
?>