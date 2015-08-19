<head>
    <title>Scrap Life - Encuadernación</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <meta name="expires" content="-1"/>
    <meta name="description" content=" " />
    <meta name="author" content=" " />
    <meta name="keywords" content=" ">
    
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/css/products.css"/>
	<script src="/js/ajaxFunctions.js"></script> 
	<script src="/js/jquery1.11.3.js"></script> 

    <link rel="shortcut icon" href="/.ico">
	
	<script>
	$( document ).ready(function() {
			$('#2').hide();
			$('#3').hide();
		});
		
	function mostrar1(){
		$('#1').show('slow');
		$('#2').hide('slow');
		$('#3').hide('slow');
	}
	
	function mostrar2(){
		$('#1').hide('slow');
		$('#2').show('slow');
		$('#3').hide('slow');		
	}
	
	function mostrar3(){
		$('#1').hide('slow');
		$('#2').hide('slow');
		$('#3').show('slow');
	}
		
	</script>
</head>

<?php 
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
			
			<div class="carrito-compras specialMargin" id='1'>
				<span class='categorias'>
				<div>						
					<div class='check'>
						<h3 class='pri choise'>1</h3>
						<span><input type='radio' name='aaa' value='aaa'  /><p>aaa</p></span>
						<span><input type='radio' name='aaa' value='aaa'  /><p>aaa</p></span>
					</div>
					<div id='$categoria_id' class='imageOptionDiv'>
						<img class='imageOption' src='/admin/imagesUpload/producto.png' /><p class='textImage'>titulo</p>
					</div>
					<span onclick='mostrar2()' class='siguienteForm opSig'>siguiente opcion</span>
				</div>
				</span>
				
			</div>
			<div class="carrito-compras specialMargin" id='2'>
				<span class='categorias'>
				<div>						
					<div class='check'>
						<h3 class='pri choise'>2</h3>
						<span><input type='radio' name='aaa' value='aaa'  /><p>aaa</p></span>
						<span><input type='radio' name='aaa' value='aaa'  /><p>aaa</p></span>
					</div>
					<div id='$categoria_id' class='imageOptionDiv'>
						<img class='imageOption' src='/admin/imagesUpload/producto.png' /><p class='textImage'>titulo</p>						
					</div>
					<span onclick='mostrar3()' class='siguienteForm opSig'>siguiente opcion</span>
				</div>
				</span>
			</div>
			<div class="carrito-compras specialMargin" id='3'>
				<span class='categorias'>
				<div>						
					<div class='check'>
					<h3 class='pri choise'>3</h3>
					<span><input type='radio' name='aaa' value='aaa'  /><p>aaa</p></span>
					<span><input type='radio' name='aaa' value='aaa'  /><p>aaa</p></span>
				</div>
					<div id='$categoria_id' class='imageOptionDiv'>
					<img class='imageOption' src='/admin/imagesUpload/producto.png' /><p class='textImage'>titulo</p>
					</div>
					<span onclick='mostrar1()' class='siguienteForm opSig'>siguiente opcion</span>
				</div>
				</span>
			</div>
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