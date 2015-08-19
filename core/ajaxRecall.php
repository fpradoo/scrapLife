<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/core/classCarrito.php");
if(isset($_GET['func'])&&!empty($_GET['func'])){
	
	$nroFuncion = (int)$_GET['func'];
	$nroFuncion = sanitize($nroFuncion);
	
	switch ($nroFuncion){
    case 1:
        showProductoSelect();
        break;
    case 2:
        showCategoriaByProduct();
        break;
	case 3:
		changeImagenBySubcat();
		break;
	}
}

function showProductoSelect(){

	$db = iniciarBD();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_producto = "Select * FROM productos WHERE id = $producto_edit";
		$run_productos = mysqli_query($db, $get_producto);
		
		while($row_productos=mysqli_fetch_array($run_productos)){
			
			$productos_id = $row_productos['id'];
			$productos_titulo = ucfirst($row_productos['titulo']);
			$productos_descripcion = ucfirst($row_productos['descripcion']);
			$productos_imagen = $row_productos['imagen'];
			
			echo "
			<div id='producto'>
			<span class='choise spanProducto'>
				<span>
				<h1 class='tituloProducto'>$productos_titulo</h1>
				<select class='productosList' id='products' name='products' onChange='showProductoSelect(this.value)'>
			";
			
			getProductosParaSelect($producto_edit);
			
			echo"
					</select>
				</span>
				<span class='description'>
					<p>$productos_descripcion</p>
					<img class='imagenProducto' src='/admin/imagesUpload/$productos_imagen' />			
				</span>
			</span>
			<form action='/producto.php' method='post' enctype='multipart/form-data'>
				<span id='categoria'>
			";
				showCategoriaByProduct($producto_edit);				
			echo"</span>
				<input type='submit' name='submit' value='Agregar al carrito'>
			</form>
			</div>";
			echo"<div class='carrito-compras'>
			<span>
				<div>
					<h3 class='title'>Pedidos</h3>
					<a href='/producto.php?deleteShopCar=1'><img class='eliminarCarrito' src='/img/carrito-compras-delete.png' /></a>
					<img class='iconoCarrito' src='/img/carrito-compras.png' />
				</div>
				<br>
				<hr>
				<div class='price-item'>
		";	
		$carrito = new Carrito();			
		$carro = $carrito->get_content();
		$total = 0;
		if($carro)
		{
			foreach($carro as $producto)
			{
				$nombre_producto = ucfirst($producto["nombre"]);
				$precio_producto = $producto["precio"];
				$cantidad_producto = $producto["cantidad"];
				$id_producto_enc = $producto["unique_id"];
				$id_producto = $producto["id"];
				$totalParcial = 0;
				$precioPorCantidad = $cantidad_producto * $precio_producto;
				$total += $precioPorCantidad; 
				$totalParcial += $precioPorCantidad;
				echo"
				<div class='price-item'>
					<h4 class='title-buy'>$nombre_producto $$precio_producto x$cantidad_producto</h4>
						<a href='/producto.php?addItem=$id_producto'><img class='agregarProducto' src='/img/add.png' /></a>
						<a href='/producto.php?deleteItem=$id_producto_enc'><img class='eliminarProducto' src='/img/carrito-compras-delete.png' /></a>					
				";
				
				foreach($producto["opciones"] as $categorias){
					foreach($categorias as $categoria){
						$nombre_categoria = ucfirst($categoria["tituloCat"]);
						$nombre_subcat = ucfirst($categoria["subcatTitulo"]);
						$precio_subcat = $categoria["subcatPrecio"];
						$precioPorCantidad = $cantidad_producto * $precio_subcat;
						$total += $precioPorCantidad;
						$totalParcial += $precioPorCantidad;
						
						echo"
						<p><span class='categoriasCarrito'>$nombre_categoria</span> - $nombre_subcat + $$precio_subcat</p>
						";
					}
				}
				
				$totalParcialDividido = $totalParcial / $cantidad_producto;
				echo"
				</div>
				<p>Precio producto: $$totalParcialDividido  -  Precio conjunto: $$totalParcial</p>
				<hr class='price'>
				";

			}
			echo"</div>
					<h5>Total: $$total </h5>
				<input type='submit' value='Aceptar Pago'>
				";
		}else{
			echo"		
				<h4 class='title-buy' style='clear:both'>Todavia no hay productos seleccionados</h4>
							
			";	
		}
		echo"
			</span>
		</div>";
		}
	}	
}

function getProductosParaSelect($prod_id){
	
	$db = iniciarBD();
	
	$get_all_productos = 'Select * FROM productos order by Titulo';
	$run_productos = mysqli_query($db, $get_all_productos);
	
	while($row_productos=mysqli_fetch_array($run_productos)){
		
		$productos_id = $row_productos['id'];
		$productos_titulo = ucfirst($row_productos['titulo']);
		
		if($prod_id == $productos_id ){
			echo "		
				<option value='$productos_id' selected>$productos_titulo</option>
			";
		}else{
			echo "		
				<option value='$productos_id'>$productos_titulo</option>
			";			
		}
		
	}	
}

function showCategoriaByProduct($producto_edit){
	
	$db = iniciarBD();
	$id_prod_padre = $producto_edit;
	
	$get_categorias = "Select * FROM categorias WHERE id_producto = $id_prod_padre AND tipo_cat = 1";
	$run_categorias = mysqli_query($db, $get_categorias);
	
	echo"
	<h2 class='categorias tituloProducto'>Externas</h2>
	";
	
	while($row_categorias=mysqli_fetch_array($run_categorias)){
		
		$categoria_titulo = ucfirst($row_categorias['Titulo']);
		$categoria_id = $row_categorias['Id'];
		$categoria_operacion = $row_categorias['tipo_op'];
		
		echo"
		<hr>
			<span class='categorias'>
			<div>						
				<div class='check'>
				<h3 class='pri choise'>$categoria_titulo</h3>
		";		
		
		$get_subcategorias = "Select * FROM detalles_categorias WHERE cat_id = $categoria_id";
		$run_subcategorias = mysqli_query($db, $get_subcategorias);
	
		while($row_subcategorias=mysqli_fetch_array($run_subcategorias)){
			
			$subcategoria_id = $row_subcategorias['id'];
			$subcategoria_titulo = ucfirst($row_subcategorias['titulo']);
			if($categoria_operacion == 1){
				echo"
				<span><input type='radio' name='$categoria_id' value='$subcategoria_id' onchange='changeImagenCategoria($subcategoria_id, $categoria_id, this.checked, this.type)' /><p>$subcategoria_titulo</p></span>
				";
				}else{
				echo"
				<span><input type='checkbox' name='$subcategoria_id' value='$subcategoria_id' onchange='changeImagenCategoria($subcategoria_id, $categoria_id, this.checked, this.type)' /><p>$subcategoria_titulo</p></span>	
				";	
			}	
		}
		
		echo"
			</div>
				<div id='$categoria_id' class='imageOptionDiv'>
				</div>
			</div>
			</span>
		";
	}
	
	$get_categorias = "Select * FROM categorias WHERE id_producto = $id_prod_padre AND tipo_cat = 2";
	$run_categorias = mysqli_query($db, $get_categorias);
	
	echo"
	<h2 class='categorias tituloProducto'>Internas</h2>
	";
	
	while($row_categorias=mysqli_fetch_array($run_categorias)){
		
		$categoria_titulo = ucfirst($row_categorias['Titulo']);
		$categoria_id = $row_categorias['Id'];
		$categoria_operacion = $row_categorias['tipo_op'];
		
		echo"
		<hr>
			<span class='categorias'>
			<div>						
				<div class='check'>
				<h3 class='pri choise'>$categoria_titulo</h3>
		";		
		
		$get_subcategorias = "Select * FROM detalles_categorias WHERE cat_id = $categoria_id";
		$run_subcategorias = mysqli_query($db, $get_subcategorias);
	
		while($row_subcategorias=mysqli_fetch_array($run_subcategorias)){
			
			$subcategoria_id = $row_subcategorias['id'];
			$subcategoria_titulo = ucfirst($row_subcategorias['titulo']);
			if($categoria_operacion == 1){
				echo"
				<span><input type='radio' name='$categoria_id' value='$subcategoria_id' onchange='changeImagenCategoria($subcategoria_id, $categoria_id, this.checked, this.type)' /><p>$subcategoria_titulo</p></span>
				";
				}else{
				echo"
				<span><input type='checkbox' name='$subcategoria_id' value='$subcategoria_id' onchange='changeImagenCategoria($subcategoria_id, $categoria_id, this.checked, this.type)' /><p>$subcategoria_titulo</p></span>	
				";	
			}	
		}
		
		echo"
			</div>
				<div id='$categoria_id' class='imageOptionDiv'>
				</div>
			</div>
			</span>
		";
	}
	
	
}


function changeImagenBySubcat(){
	$db = iniciarBD();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);
		$viejoCodigo = $_GET['viejoCod'];
		$state = $_GET['checkState'];		
		$estado = 'libre';
		$tipo = $_GET['type'];
		
		$get_all_subcategorias_by_categoria = "Select * FROM detalles_categorias where id = '$producto_edit'";
		$run_categorias = mysqli_query($db, $get_all_subcategorias_by_categoria);
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			$subcategorias_imagen = $row_categorias['imagen'];
			$subcategorias_titulo = $row_categorias['titulo'];
			$subcategorias_titulo = cleanText($subcategorias_titulo);
			$imagenEntera = '<img class="imageOption" src="/admin/imagesUpload/'.$subcategorias_imagen.'"><p class="textImage">'.$subcategorias_titulo.'</p>';
			if($tipo == 'checkbox'){
				if($state == 'false'){
					$estado = 'ocupado';
					$viejoCodigo = str_replace($imagenEntera,"",$viejoCodigo);
				}
				
				if (strpos($viejoCodigo,$subcategorias_imagen) !== false || $estado == 'ocupado') {
					echo "
					$viejoCodigo			
					";
				}else{
				echo "
					$viejoCodigo
					<img class='imageOption' src='/admin/imagesUpload/$subcategorias_imagen' /><p class='textImage'>$subcategorias_titulo</p>
				";
				}
			}else{
				echo"
				<img class='imageOption' src='/admin/imagesUpload/$subcategorias_imagen' /><p class='textImage'>$subcategorias_titulo</p>
				";
			}		
	    }
	}
}

function iniciarBD(){
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$bd = 'scraplife';
	
	$db = mysqli_connect("$server","$user","$pass","$bd");
	if(mysqli_connect_errno()){
		echo 'La conexion con la base de datos ha fallado con los siguientes errores: '. mysqli_connect_error();
		die();
	}
	
	return $db;
}

function cleanText($string){
	$string = str_replace("&aacute;","á",$string);
	$string = str_replace("&eacute;","é",$string);
	$string = str_replace("&iacute;","í",$string);
	$string = str_replace("&oacute;","ó",$string);
	$string = str_replace("&uacute;","ú",$string);
	$string = str_replace("&ntilde;","ñ",$string);
	return $string;
}

//Seguridad
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
?>