<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include_once ($_SERVER['DOCUMENT_ROOT']."/core/classCarrito.php");

function checkProductosFinalizado(){
	$carrito = new Carrito();
	$carro = $carrito->get_content();
	if($carro){	
		foreach($carro as $producto){
			if($producto["finalizado"] == false){
				$carrito = new Carrito();
				$carrito->remove_producto($producto["unique_id"]);
			}
		}			
	}
}

function deleteSession(){
	if(isset($_GET['deleteShopCar'])){
		$carrito = new Carrito();
		$carrito->destroy();
		getSeccionProductosById();
	}
}

function echoProducts(){
	$db = callDb();
	
	$get_prod = "SELECT p.titulo, p.id, p.imagen from productos p inner join categorias c ON c.id_producto = p.id GROUP BY p.titulo";
	$run_prod = mysqli_query($db, $get_prod);
	
	while($row_prod=mysqli_fetch_array($run_prod)){
		
		$titulo_prod = $row_prod['titulo'];
		$id_prod = $row_prod['id'];
		$img_prod = $row_prod['imagen'];
		
		echo"
		
		<div class='circProd'>
			<a href='/producto.php?id=$id_prod'>
				<img class='circProd img-circle' src='/admin/imagesUpload/$img_prod'>
				<h3 class='subtit'>$titulo_prod</h3>
			</a>
		</div>
		";	
	}
}

function getSeccionProductosById(){
	
	if(isset($_GET['id'])){
		
		$id_prod = $_GET['id'];
		echo"
		<script>
			showProductoSelect($id_prod);
		</script>
		";
	}else{
		
		$carrito = new Carrito();
		$carro = $carrito->get_content();
		
		if(is_null($carro)){
			$db = callDb();
		
			$get_all_productos = 'SELECT p.titulo, p.id from productos p inner join categorias c ON c.id_producto = p.id GROUP BY p.titulo LIMIT 1';
			$run_productos = mysqli_query($db, $get_all_productos);
			
			while($row_productos=mysqli_fetch_array($run_productos)){
				$productos_id = $row_productos['id'];

				echo"
					<script>
						showProductoSelect($productos_id);
					</script>
					";
			}
		}
	}	
}

function generarMP($nombre, $apellido){
	$mp = new MP('8992299227915757', 'mKhyUgOgwVsrZLcPLNC6lWBelo7PIoQL');

	$preference_data = array(
		"items" => array(
			array(
				"title" => "Donación para CLUBNIVA.COM",
				"currency_id" => "ARS",
				"picture_url" =>"http://www.clubniva.com/images/logos/logo.jpg",
				"category_id" => "Donación",
				"quantity" => 1,
				"unit_price" => 100
			)
		),
		"payer" => array(
			"name" => $nombre,
			"surname" => $apellido
		)	
	);
	
	$preference = $mp->create_preference($preference_data);	
	$href = $preference['response']['init_point'];
	
	echo"
	<div style='position:absolute'>	
		<a href='$href'>Pagar con Mercado Pago</a>
	</div>
	";
	
}

function generarPayU($nombre, $apellido, $email){

	//$carrito = new Carrito();
	$total = 10;
	//echo $total;
	$referenceCode = "SCR".date("hsi");
	//ApiKey~merchantId~referenceCode~amount~currency
	$signature = md5("6u39nqhq8ftd0hlvnjfs66eh8c~500238~$referenceCode~$total~ARS");
	$nombreApellido = $nombre . ' ' . $apellido;

	echo"
	
	<form class='pagar datos' method='post' action='https://stg.gateway.payulatam.com/ppp-web-gateway/'>
		<input name='payerFullName' type='hidden'  value='$nombreApellido' > 
		<input name='buyerEmail'  	type='hidden'  value='$email' > 
		<input name='merchantId'    type='hidden'  value='500238' >
		<input name='accountId'     type='hidden'  value='509171' >
		<input name='description'   type='hidden'  value='Productos' >
		<input name='referenceCode' type='hidden'  value='$referenceCode' >
		<input name='amount'        type='hidden'  value='$total' >
		<input name='tax'           type='hidden'  value='21'  >
		<input name='taxReturnBase' type='hidden'  value='0' >
		<input name='currency'      type='hidden'  value='ARS' >
		<input name='signature'     type='hidden'  value='$signature'>
		<input name='test'          type='hidden'  value='1' >
		<input name='buyerEmail'    type='hidden'  value='test@test.com' >
		<input name='responseUrl'   type='hidden'  value='http://45.55.71.214/payUResponse.php' >
		<input name='ApiLogin'    	type='hidden'  value='11959c415b33d0c' >		
		<input name='ApiKey'    	type='hidden'  value='6u39nqhq8ftd0hlvnjfs66eh8c' >
		<input name='Submit'        type='submit'  value='Pagar con PAYU' >
	</form>
	";	
}

function convenirConVendedor(){
	echo "aaaaaaaa";
	
}

?>