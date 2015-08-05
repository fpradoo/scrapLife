<?php 
	include_once ("/includes/header.php");
	include_once ("/includes/navigation.php");
	include_once ("/core/functions.php");	
?>

	<div class="main">
		<div id='producto'>
		<span class='choise spanProducto'>
			<span>
				<h1 class='tituloProducto'>Cuadernos</h1>
				<select class='productosList' name='products' onchange='showProductoSelect(this.value)'>
					<?php getProductosParaSelect(); ?>
				</select>
			</span>
				<span class="description">
					<p>Los cuadernos están realizados con papel bookcel de 80 gr. Cosidos a mano y encuadernados artesanalmente. Los cuadernos personalizados son exclusivos y diseñados especialmente para vos.</p>
					<img class='imagenProducto' src="/img/product.jpg" />			
				</span>
		</span>
			
				<span>
					<span>
						<h2 class="categorias tituloProducto">Sección</h2>
						<select class='seccionList' name="item-choise">
							<option value="1">Item</option>
							<option value="2">Item</option>
							<option value="3">Item</option>
						</select>
						<span class="choise">
						<h3 class="pri choise">Titulo</h3>
						<div>
							<div class="radio">
								<span><input type="radio" name="check" value="1"><p>Item</p></span>
								<span><input type="radio" name="check" value="2"><p>Otro Item</p></span>
							</div>
							<div class="imageOptionDiv">
								<img class="imageOption" src="/img/product.jpg" />
							</div>
						</div>
						</span>
						<span class="choise">
						<h3 class="choise">Titulo2</h3>
						<div>
							<div class="check">
								<span><input type="checkbox" name="check" value="1"><p>Item</p></span>
								<span><input type="checkbox" name="check" value="2"><p>Item</p></span>
								<span><input type="checkbox" name="check" value="3"><p>Otro Item</p></span> 
								<span><input type="checkbox" name="check" value="4"><p>Otro Item</p></span> 
								<span><input type="checkbox" name="check" value="5"><p>Item</p></span>
							</div>
							<div class="imageOptionDiv">
								<img class="imageOption" src="/img/product.jpg" />
							</div>
						</div>
						</span>
					</span>
					<span class="image-description">
						
						
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
						<h4 class="title-buy">Cuaderno $150</h4>
						<p>Item + $50</p>
						<p>Otro Item + $120</p>
						<p>Item + $30</p>
					</div>
				<hr class="price">
				<h5>Total: $330</h5>
				<input type="submit" value="Aceptar Pago">
			</span>
		</div>
	</div>
	
<?php include_once("/includes/footer.php");?>