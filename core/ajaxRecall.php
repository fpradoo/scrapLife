<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include_once ($_SERVER['DOCUMENT_ROOT']."/core/classCarrito.php");
if(isset($_GET['func'])&&!empty($_GET['func'])){
	
	$nroFuncion = (int)$_GET['func'];
	$nroFuncion = sanitize($nroFuncion);
	
	switch ($nroFuncion){
    case 1:
        showProductoSelect();
        break;
	case 3:
		changeImagenBySubcat();
		break;
	case 4:
		mensajeFinal();
		break;
	case 5:
		actualizarCarrito();
		break;
	}
}

function showProductoSelect(){

	$db = callDb();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);

		$get_producto = "Select * FROM productos WHERE id = $producto_edit";
		$run_productos = mysqli_query($db, $get_producto);
		
		while($row_productos=mysqli_fetch_array($run_productos)){
			
			$productos_titulo = ucfirst($row_productos['titulo']);
			$productos_descripcion = ucfirst($row_productos['descripcion']);
			$productos_imagen = $row_productos['imagen'];
			$productos_precio = $row_productos['precio'];
			
			$carrito = new Carrito();
			
			$carro = $carrito->get_content();
			if($carro)
			{	
				foreach($carro as $producto){
					if($producto['unique_id'] != md5($producto_edit)){
						
					$articulo = array(
						"id"			=>		$producto_edit,
						"cantidad"		=>		1,
						"precio"		=>		$productos_precio,
						"nombre"		=>		$productos_titulo,
						"opciones"      =>      array(),
						"uniqueId"      =>      $producto_edit,
						"imagen"		=>      $productos_imagen
					);
					
					$carrito->add($articulo);
							
					}
				}
			}
			
			//Seleccion de producto
			echo"
			<div id='main' class='main productDisplay'>
				<div class='productDisplay1'>
					<a href='/index.php' title='Dreri'><img src='/img/scraplife-logo.jpg' class='img-circle img-logo'></a>
					<div class='productDisplay2'>
						<h2 class='prdDisTitle'>Comenzá ahora a armar tu</h3>
						<h3 class='prdDisTitle2'>Completá los siguientes pasos hasta armar tu pedido</h3>
					</div>
				</div>
				<div class='productDisplay3'>
					<div class='productDisplay4'>	
						<img src='/admin/imagesUpload/$productos_imagen' class='img-circle img-prd'>
					</div>
					<div class='productDisplay5'>
						<select id='products' class='productosList selectProduct' name='products' onChange='showProductoSelect(this.value)'>
			";		
			getProductosParaSelect($producto_edit);
			echo"			
						</select>
					</div>
				</div>
				<div class='productDisplay6'>
					<a class='backUrl' href='/index.php'>Volver al inicio</a>
				</div>
			</div>
			<hr>
			";
			
			generarOpcionesEditables($producto_edit, $productos_descripcion);
			generarCarrito();
			
		}
	}	
}

function getProductosParaSelect($prod_id){
	
	$db = callDb();
	
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

function generarOpcionesEditables($idProd, $prod_desc){
	
	echo"
	<div class='main'>
		<div class='seccOp'>
			<span class='description'>
				<p>$prod_desc</p>			
			</span>
			<div id='opcinesCompleto'>
	";
	
	$contador = 1;
	$db = callDb();
	
	$get_categorias = "Select * FROM categorias where id_producto = $idProd";
	$run_categorias = mysqli_query($db, $get_categorias);
	$totalCategorias = mysqli_num_rows($run_categorias);
	
	
	while($row_categorias=mysqli_fetch_array($run_categorias)){
	
	$categoria_id = ($row_categorias['Id']);
	$categoria_titulo = ucfirst($row_categorias['Titulo']);

	if($contador == 1){
		echo"<div id='$contador'>";
	}else{
		echo"<div id='$contador' style='display:none;'>";
	}
	
	echo"
			<span class='description descCartel'>
				<span class='descCartelTexto'>Paso $contador de $totalCategorias</span>			
			</span>
			<h2 class='categorias titCat'>$categoria_titulo</h2>
			<center class='prod'>
			
			";
			$contador++;
			$get_subcategorias = "Select * FROM detalles_categorias where cat_id = $categoria_id";
			$run_subcategorias = mysqli_query($db, $get_subcategorias);
		
			while($row_subcategorias=mysqli_fetch_array($run_subcategorias)){
				$subcat_id = $row_subcategorias['id'];
				$subcat_titulo = ucfirst($row_subcategorias['titulo']);
				$subcat_imagen = $row_subcategorias['imagen'];
				$subcat_precio = $row_subcategorias['precio_adicional'];
			
			echo"
				<div class='circProd auto'>
					<img class='circProd img-circle imgSize1' src='/admin/imagesUpload/$subcat_imagen'>
					<h3 class='text-center subCatTitle'>$subcat_titulo</h3>
					<h4 class='text-center'>$subcat_precio</h4>
					<input class='inputSubcat' type='checkbox' name='$categoria_id' value='$subcat_id'>
				</div>
			";
			}
			echo"
			</center>
			<span class='description descCartel'>
			";
			if($contador - 1 == $totalCategorias){
				echo"<span class='descCartelTexto' style='cursor:pointer;' onclick='finalEdicion()'>Siguiente paso ></span>";
			}else{
				echo"<span class='descCartelTexto' style='cursor:pointer;' onclick='cambiarCategoria($contador, $categoria_id)'>Siguiente paso ></span>";
			}
							
			echo"
			</span>
		</div>
		";	
	}
	echo"
				<label id='error' style='display:none; color: red;'>Por favor, seleccione al menos una opción.</label>
			</div>
		</div>
	";
	
}

function generarCarrito(){
	//Seccion carrito
	echo"
		<div class='carrito-compras'>
			<span class='carrito'>
				<div>
					<h3 class='title pedido'>Pedido</h3>
					<img src='/img/carrito-compras.png' />
				</div>
		";
	
	//Consigo el contenido del carrito	
	$carrito = new Carrito();
	$carro = $carrito->get_content();
	if($carro)
	{	
		foreach($carro as $producto)
		{
			$pro_tit = $producto["nombre"];
			$pro_img = $producto["imagen"];
			//Seccion cabecera del producto
			echo"
			<hr class='negro'>
				<div>
					<h2 class='titProd'>$pro_tit</h3>
					<img src='/admin/imagesUpload/$pro_img' class='img-circle imgSize2'>
				</div>
			";
			
			//Seccion opciones del producto
			
			if(empty($producto["opciones"])){
				echo"
				<hr class='negro'>				
					<center id='opcionesSeleccionadas'>
						<h2 class='titProd'>Aun no hay opciones seleccionadas</h3>
					</center>
				";	
			}else{
				echo"
					<hr class='negro'>				
					<center id='opcionesSeleccionadas'>
				";
				
				foreach($producto["opciones"] as $subCat){
					$db = callDb();
					$get_subCat = "Select * FROM detalles_categorias WHERE id = $subCat";
					$run_subCat = mysqli_query($db, $get_subCat);
				
					while($row_subCat=mysqli_fetch_array($run_subCat)){
						$productos_titulo = ucfirst($row_subCat['titulo']);
						$productos_imagen = $row_subCat['imagen'];
						$productos_precio = $row_subCat['precio_adicional'];
						
						echo"
							<div class='mas'>
								+
							</div>
							<div class='circProd elementCarrito'>
								<img class='circProd img-circle imgSize3' src='/admin/imagesUpload/$productos_imagen'>
								<h3 class='text-center titCatCarrito'>$productos_titulo</h3>
								<h4 class='text-center'>$productos_precio</h4>
							</div>
						";						
					}		
				}
				echo"	
					</center>
				";
			}
		}
	}
	
	echo"
		<hr class='negro clear'>
				<h5 class='total'>Total: 330</h5>
				<hr class='negro clear'>
				<input type='submit' value='Pagar'>
			</span>
		</div>
	</div>
	";
}

function mensajeFinal(){
	echo"
	<h3 style='color:blue;'>La edición del producto esta finalizada</h3>
	";
}

function actualizarCarrito(){
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		$opciones = array();
		array_push($opciones, $_GET['q']);
			
		$carrito = new Carrito();
			$articulo = array(
				"id"			=>		null,
				"cantidad"		=>		1,
				"precio"		=>		null,
				"nombre"		=>		null,
				"opciones"      =>      $opciones,
				"uniqueId"      =>      intval($_GET['idPadre']),
				"imagen"		=>      null
			);
		
		$carrito->addOption($articulo);
		

		$carro = $carrito->get_content();
		if($carro)
		{	
			foreach($carro as $producto)
			{		
				foreach($producto["opciones"] as $subCat){
					$db = callDb();
					$get_subCat = "Select * FROM detalles_categorias WHERE id = $subCat";
					$run_subCat = mysqli_query($db, $get_subCat);
				
					while($row_subCat=mysqli_fetch_array($run_subCat)){
						$productos_titulo = ucfirst($row_subCat['titulo']);
						$productos_imagen = $row_subCat['imagen'];
						$productos_precio = $row_subCat['precio_adicional'];
						
						echo"
							<div class='mas'>
								+
							</div>
							<div class='circProd elementCarrito'>
								<img class='circProd img-circle imgSize3' src='/admin/imagesUpload/$productos_imagen'>
								<h3 class='text-center titCatCarrito'>$productos_titulo</h3>
								<h4 class='text-center'>$productos_precio</h4>
							</div>
						";						
					}		
				}
			}
		}
	}
}


function changeImagenBySubcat(){
	$db = callDb();
	
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