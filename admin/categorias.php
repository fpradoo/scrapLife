<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	checkAndInsertProducto();
	deleteProducto()
	
?>
<h2 class="text-center">Categorias</h2>
<div class="text-center">
	<form class="form-inline" action="categorias.php" method="post">
		<div class="form-group">
			<label for="categoria">Agregar una categoria:</label>
			<input type="text" name="categoria" id="categoria" class="form-control" value="<?php echo ((isset($_POST['categoria']))?$_POST['categoria']:''); ?>"; />
			<input type="submit" name="add_submit" id="categoria" class="btn btn-success" value="Agregar categoria"; />
		</div>
	
	</form>
</div><hr>
<table class="table table-bordered table-striped table-auto">
	<thead>
		<th>
		</th>
		<th>
		Categorias
		</th>
		<th>
		</th>
	</thead>
	<tbody>
		
			<?php getCategorias(); ?>
		
	</tbody>
</table>
<?php
	include 'includes/footer.php';
?>