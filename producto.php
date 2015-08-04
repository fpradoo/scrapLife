<?php 
	include_once ("/includes/header.php");
	include_once ("/includes/navigation.php");
?>

	<div class="main">
		<span>
			<h1>Cuadernos</h1>
			<select name="products">
				<option>Cuadernos</option>
				<option>Libros</option>
				<option>Albumes</option>
			</select>
		</span>
		<div>
			<span class="description">
				<p>Los cuadernos están realizados con papel bookcel de 80 gr. Cosidos a mano y encuadernados artesanalmente. Los cuadernos personalizados son exclusivos y diseñados especialmente para vos.</p>
				<img src="/img/product.jpg" />			
			</span>
			<span class="choise">
				<span class="choise-item">
					<h2>Elegí tu combo</h2>
					<select name="item-choise">
						<option value="1">Item</option>
						<option value="2">Item</option>
						<option value="3">Item</option>
					</select>
					<h3 class="pri choise">Titulo</h3>
					<div class="radio">
						<span><input type="radio" name="check" value="1"><p>Item</p></span>
						<span><input type="radio" name="check" value="2"><p>Otro Item</p></span>
						<div class="clear"></div>
					</div>
					<h3 class="choise">Titulo2</h3>
					<div class="check">
						<span><input type="checkbox" name="check" value="1"><p>Item</p></span>
						<span><input type="checkbox" name="check" value="2"><p>Item</p></span>
						<span><input type="checkbox" name="check" value="3"><p>Otro Item</p></span> 
						<span><input type="checkbox" name="check" value="4"><p>Otro Item</p></span> 
						<span><input type="checkbox" name="check" value="5"><p>Item</p></span>
						<div class="clear"></div>
					</div>
				</span>
				<span class="image-description">
					<img src="/img/product.jpg" />
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