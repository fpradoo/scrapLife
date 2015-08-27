<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include_once ($_SERVER['DOCUMENT_ROOT']."/core/classCarrito.php");

function getProductosParaSelect(){
	
	$db = callDb();
	
	$get_all_productos = 'Select * FROM productos order by Titulo';
	$run_productos = mysqli_query($db, $get_all_productos);
	
	while($row_productos=mysqli_fetch_array($run_productos)){
		
		$productos_id = $row_productos['id'];
		$productos_titulo = ucfirst($row_productos['titulo']);
		
		echo "		
		<option value='$productos_id'>$productos_titulo</option>
		";
	}	
}

function getProductosParaNavigation(){
	
	$db = callDb();
	
	$get_all_productos = 'Select * FROM productos order by Titulo';
	$run_productos = mysqli_query($db, $get_all_productos);
	
	while($row_productos=mysqli_fetch_array($run_productos)){
		
		$productos_id = $row_productos['id'];
		$productos_titulo = ucfirst($row_productos['titulo']);
		
		echo "		
		<li><a href='/producto.php?idProd=$productos_id'>$productos_titulo</a></li>
		";
	}	
}

function getSeccionProductos(){
	if(!isset($_GET['id'])){	
		echo"
		<div id='main' class='main'>
			<select id='products' class='productosList' name='products' onchange='showProductoSelect(this.value)'>
		";
		getProductosParaSelect();
		echo"			
		</select>
				
		</div>
		<script>
			showProductoSelect( $('#products').val() );
		</script>
		";
	}
}

function armarCarrito(){
	$carrito = new Carrito();	
	if(isset($_POST['submit'])){
		$en = "(";
		foreach($_POST as $value){
			if($value != 0 && $value != '0'){
				$en .= $value.",";
				$id = intval($value);
			}		
		}
		$en .= ")";
		$en = substr_replace($en, '', -2, -1);
		
		$db = callDb();
		
		$get_subcat = "SELECT dc.id as subcatId, dc.titulo as subcatTitulo, dc.precio_adicional as subcatPrecio, c.Id as idCat, c.Titulo as tituloCat FROM detalles_categorias dc INNER JOIN categorias c ON dc.cat_id = c.Id WHERE dc.id in $en";
		$run_subcat = mysqli_query($db, $get_subcat);
		$opciones = array();
		$opcionesUniqueId = array();
		$idUnique = 0;
		
		while($row_subcat=mysqli_fetch_array($run_subcat)){
			$opciones[ $row_subcat['subcatId'] ][] = $row_subcat;
			$opcionesUniqueId[ $row_subcat['subcatId'] ] = $row_subcat['subcatId'];
		}
		
		natsort($opcionesUniqueId);
		
		foreach($opcionesUniqueId as $number){
			$idUnique += intval($number);
		}
		
		$get_prod = "SELECT p.id as prodId, p.titulo as tituloProd, p.precio as precioProd FROM detalles_categorias dc INNER JOIN categorias c ON dc.cat_id = c.Id INNER JOIN productos p ON c.id_producto = p.id WHERE dc.id = $id";
		$run_prod = mysqli_query($db, $get_prod);
		
		while($row_prod=mysqli_fetch_array($run_prod)){
			
			$productos_id = $row_prod['prodId'];
			$productos_titulo = ucfirst($row_prod['tituloProd']);
			$productos_precio = ucfirst($row_prod['precioProd']);
			
			$articulo = array(
				"id"			=>		$idUnique,
				"cantidad"		=>		1,
				"precio"		=>		$productos_precio,
				"nombre"		=>		"$productos_titulo",
				"opciones"      =>      $opciones,
				"uniqueId"      =>      $idUnique
			);
		$carrito->add($articulo);
		}
	}
}

function deleteSession(){
	if(isset($_GET['deleteShopCar'])){
		$carrito = new Carrito();
		$carrito->destroy();
	}
}

function deleteItem(){
	if(isset($_GET['deleteItem'])){		
		$id_unique = $_GET['deleteItem'];
		$carrito = new Carrito();
		$carrito->remove_producto("$id_unique");
	}
}

function addItem(){
	if(isset($_GET['addItem'])){		
		$idUnique = intval($_GET['addItem']);
		$carrito = new Carrito();
		$articulo = array(
			"id"			=>		null,
			"cantidad"		=>		1,
			"precio"		=>		null,
			"nombre"		=>		null,
			"opciones"      =>      null,
			"uniqueId"      =>      $idUnique
		);
		$carrito->addItem($articulo);
	}
}

function echoProducts(){
	$db = callDb();
	
	$get_prod = "SELECT * from productos";
	$run_prod = mysqli_query($db, $get_prod);
	
	while($row_prod=mysqli_fetch_array($run_prod)){
		
		$titulo_prod = $row_prod['titulo'];
		$id_prod = $row_prod['id'];
		
		echo"
		<li>
			<div class='progress'>
				<div class='progress-bar' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%;'><a class='white' href='/producto.php?id=$id_prod'>$titulo_prod</a></div>
			</div>
		</li>
		";	
	}
}

function getSeccionProductosById(){
	
	if(isset($_GET['id'])){
		
		$id_prod = $_GET['id'];
		echo"
		<div id='main' class='main'>
			<select id='products' class='productosList' name='products' onchange='showProductoSelect(this.value)'>
		";
		getProductosParaSelect();
		echo"			
		</select>
				
		</div>
		<script>
			showProductoSelect($id_prod);
		</script>
		";
	}
}


?>