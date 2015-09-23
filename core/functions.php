<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include_once ($_SERVER['DOCUMENT_ROOT']."/core/classCarrito.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/mp/lib/mercadopago.php");

function checkProductosFinalizado(){
	$carrito = new Carrito();
	$carro = $carrito->get_content();
	if($carro){	
		foreach($carro as $producto){
			//var_dump($producto);
			if($producto["finalizado"] == false && $producto["productofinal"] != 1){
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
	
	$get_prod = "SELECT p.titulo, p.id, p.imagen from productos p inner join categorias c ON c.id_producto = p.id WHERE p.activo = 1 AND c.activo = 1 GROUP BY p.titulo";
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
	
	$get_prod = "SELECT * from productos where productofinal = 1 and activo = 1";
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
		
			$get_all_productos = 'SELECT p.titulo, p.id from productos p inner join categorias c ON c.id_producto = p.id WHERE p.activo = 1 and c.activo = 1 GROUP BY p.titulo LIMIT 1';
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

function seleccionarEnvio($nombre, $apellido, $tel, $email, $dire, $nroDire, $ciudad, $codPostal, $provincia, $pais){
	$mp = new MP('3605572364316323', 'NWuYGI05Lg3FQeB6XQ9oY0ISFfu14r7M');
	$params = array(
		"dimensions" => "30x30x30,500",
		"zip_code" => "$codPostal"
	);
	
	$response = $mp->get("/shipping_options", $params);
	echo"
		<div style='width:60%;'> 
		<form method='POST' action='/order.php'>	
			<table class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th>Metodo de envio</th>
						<th>Días estimados</th>
						<th>Costo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<input type='radio' name='shippingOption' id='0' value='0'>
							<label for='taller'>&nbsp;Retiro por taller</label>
						</td>
						<td>
							-
						</td>
						<td>
							Sin costo agregado
						</td>
					</tr>
	";
					
	$shipping_options = $response['response']['options'];

	foreach($shipping_options as $shipping_option) {

		$value = $shipping_option['shipping_method_id'];
		$name = $shipping_option['name'];
		$checked = $shipping_option['display'] == "recommended" ? "checked='checked'" : "";

		$shipping_speed = $shipping_option['speed']['shipping'];
		$estimated_delivery = $shipping_speed < 24 ? 1 : ceil($shipping_speed / 24); //from departure, estimated delivery time

		$cost = $shipping_option['cost'];
		$cost = $cost == 0 ? "FREE" : "$$cost";

	echo"
		<tr>
			<td>
				<input type='radio' name='shippingOption' id='$value' value='$value-$name-$estimated_delivery-$cost' $checked>
				<label for='$value'>&nbsp;$name</label>
			</td>
			<td>
				$estimated_delivery
			</td>
			<td>
				$cost
			</td>
		</tr>
	";				
					
	}
	echo"					
			</tbody>
		</table>
		<input type='hidden' value='$nombre' name='nombre' />
		<input type='hidden' value='$apellido' name='apellido' />
		<input type='hidden' value='$tel' name='tel' />
		<input type='hidden' value='$email' name='email' />
		<input type='hidden' value='$dire' name='dire' />
		<input type='hidden' value='$nroDire' name='nroDire' />
		<input type='hidden' value='$ciudad' name='ciudad' />
		<input type='hidden' value='$codPostal' name='codPostal' />
		<input type='hidden' value='$provincia' name='provincia' />
		<input type='hidden' value='$pais' name='pais' />
		
		<input type='hidden' value='generarResumen' name='optionOrder' />
		<input type='submit'>
	</form>
	</div>
	";
	
}

function generarResumen($nombre, $apellido, $tel, $email, $dire, $nroDire, $ciudad, $codPostal, $provincia, $pais, $shippingOption){
	$mp = new MP('3605572364316323', 'NWuYGI05Lg3FQeB6XQ9oY0ISFfu14r7M');
	
	$opcionDeEnvio = explode('-', $shippingOption);
	if($shippingOption != 0){
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
			),
			"shipments" => array(
				"mode" => "me2",
				"dimensions" => "30x30x30,500",
				"local_pickup" => false,
				"default_shipping_method" => intval($opcionDeEnvio[0]),
				"zip_code" => $codPostal,
				"receiver_address" => array(
					"zip_code" => $codPostal,
					"street_name" => $dire,
					"street_number" => $nroDire
				)
			)
		);
		
	}else{
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
			),
			"shipments" => array(
				"local_pickup" => true
			)
		);
	}
	
	$preference = $mp->create_preference($preference_data);	
	$href = $preference['response']['init_point'];
	
	echo"
	<div style='width:60%'>	
		<span class='description'>
			<h2 class='prdDisTitleBlue'>Resumen final de compra</h2>			
		</span>
		<div class='detalles'>
			<div class='datos'>
				<h3 class='title pedido'>Datos del comprador</h3>
				<div>
					<div><span>Nombre:</span> $nombre</div>
					<div><span>Apellido:</span> $apellido</div>
					<div><span>Telefono:</span> $tel</div>
				</div>
				<div>
					<div><span>Email:</span> $email</div>
					<div><span>Dirección:</span> $dire</div>
					<div><span>Ciudad:</span> $ciudad</div>
				</div>
				<div>
					<div><span>Codigo Postal:</span> $codPostal</div>
					<div><span>Provincia:</span> $provincia</div>
					<div><span>País:</span> $pais</div>
				</div>
			</div>
		</div>

		<div class='detalles'>
			<div class='datos'>
				<h3 class='title pedido'>Datos de la compra</h3>
		";
		$carrito = new Carrito();
		$carro = $carrito->get_content();
		if($carro){
			foreach($carro as $producto){
			$pro_tit = $producto["nombre"];
			$pro_img = $producto["imagen"];
			$pro_id = $producto["id"];
				echo"
					<div>
						<div><span>Producto:</span> $pro_tit</div>
						<div><span>Cantidad:</span> 2</div>
						<div><span>Precio:</span> 4</div>
					</div>
				";
			}
		}
		
		if($shippingOption == 0){
			echo"
				<div>
					<div><span>Forma de envio:</span> Retiro por el local</div>
					<div><span>Total:</span> Sin costo agregado</div>
					<div><span>Días estimados de entrega:</span> -</div>
				</div>
			";				
		}else{
			echo"
				<div>
					<div><span>Forma de envio:</span> $opcionDeEnvio[1] </div>
					<div><span>Total:</span> $opcionDeEnvio[3] </div>
					<div><span>Días estimados de entrega:</span> $opcionDeEnvio[2] </div>
				</div>
			";
		}
		echo"

			</div>
		</div>		
		<a href='$href'><button class='irMP' type='submit' class='btn btn-default'>Pagar con Mercado Pago</button></a>
	</div>
	";
}

?>