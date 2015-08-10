<?php 
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/navigation.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");	
?>

	<div class="main">
		<div id='producto'>
		<span class='choise spanProducto'>
			<span>
				<h1 class='tituloProducto'>Cuadernos</h1>
				<select id='products' class='productosList' name='products' onchange='showProductoSelect(this.value)'>
					<?php getProductosParaSelect(); ?>
				</select>
			</span>
				<span class="description">
					<p>Los cuadernos están realizados con papel bookcel de 80 gr. Cosidos a mano y encuadernados artesanalmente. Los cuadernos personalizados son exclusivos y diseñados especialmente para vos.</p>
					<img class='imagenProducto' src="/img/product.jpg" />			
				</span>
		</span>			

		<span>
			<h2 class="categorias tituloProducto">Secciones</h2>
			<select class='seccionList' name="item-choise" onchange='showCategoriasDeProducto(this.value)'>
				<option selected value=''>Seleccione</option>
				<option value="2">Interna</option>
				<option value="1">Externa</option>
			</select>
			<span class='aclaracion'>Elija que sección del producto desea editar.</span>
			<span id='categoria'>
				
			</span>
		</span>			
		</div>
		<div class="carrito-compras">
			<span>
				<div>
					<h3 class="title">Pedidos</h3>
					<img src="/img/carrito-compras.png" />
				</div>
				<br>
				<hr>
					<div class="price-item">
						<h4 class="title-buy">Todavia no hay productos seleccionados</h4>
					</div>
				<hr class="price">
				<h5>Total: </h5>
				<input type="submit" value="Aceptar Pago">
			</span>
		</div>
	</div>
	
<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php");?>