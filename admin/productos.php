<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	checkAndInsertProducto();
	deleteProducto();
	
?>
<h2 class="text-center">Productos</h2>
<div class="text-center">
	<form class="form-inline" action="productos.php" method="post">
		<div class="form-group">
			<label for="producto">Agregar un producto:</label>
			<input type="text" name="producto" id="producto" class="form-control" value="<?php echo ((isset($_POST['productos']))?$_POST['productos']:''); ?>"; />
			<input type="submit" name="add_submit" id="producto" class="btn btn-success" value="Agregar producto"; />
		</div>
	
	</form>
</div><hr>
<table class="table table-bordered table-striped table-auto">
	<thead>
		<th>
		</th>
		<th>
		Productos
		</th>
		<th>
		</th>
	</thead>
	<tbody>
		
			<?php getProductos(); ?>
		
	</tbody>
</table>
<?php
	include 'includes/footer.php';
?>