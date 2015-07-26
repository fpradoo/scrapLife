<?php
	require_once'../core/init.php';
	require_once'../admin/core/functions.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	checkAndInsertProducto();
	deleteProducto();
	
?>
<h1>Editar producto </h1>
	<div style="width:60%; margin-left:20px;">
		<form role="form">
			<div class="form-group">
				<label for="titulo">Titulo:</label>
				<input name="titulo" type="text" class="form-control" id="titulo">
			</div>
			<div >
				<label for="descripcion">Descripción:</label>
				<textarea class="form-control" rows="3" name="descripcion" id="descripcion" value="aaaa" text="bbbbb"></textarea> 
			</div>
			<div class="form-group">
				<label for="precio">Precio:</label>
				<input name="precio" type="text" class="form-control" id="precio">
			</div>
			<div class="checkbox">
				<label><input name="activo" id="activo" type="checkbox"> Activo</label>
			</div>
			<button type="submit" class="btn btn-default">Guardar</button>
		</form>
	</div><hr>
	
<?php
	include 'includes/footer.php';
?>