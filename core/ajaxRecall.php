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
	case 2:
		mensajeFinal();
		break;
	case 3:
		actualizarCarrito();
		break;
	case 4:
		borrarUltimaOpcion();
		break;
	case 5:
		eliminarProducto();
		break;
	}
}

function showProductoSelect(){
	
	//Borro si existen productos incompletos en sesion
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

	$db = callDb();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);

		$get_producto = "Select * FROM productos WHERE id = $producto_edit AND activo = 1";
		$run_productos = mysqli_query($db, $get_producto);
		
		while($row_productos=mysqli_fetch_array($run_productos)){
			
			$productos_titulo = ucfirst($row_productos['titulo']);
			$productos_descripcion = ucfirst($row_productos['descripcion']);
			$productos_imagen = $row_productos['imagen'];
			$productos_precio = $row_productos['precio'];
			$productoFinal = ($row_productos['productofinal'] == 1) ? true : false;
			$finalizado = ($productoFinal) ? true : false;
			
			$carrito = new Carrito();
			
			$carro = $carrito->get_content();
	
			//Inicio para productos simples y con opciones si el carrito esta vacio
			if(is_null($carro)){
				$articulo = array(
					"id"			=>		$producto_edit,
					"cantidad"		=>		1,
					"precio"		=>		$productos_precio,
					"nombre"		=>		$productos_titulo,
					"opciones"      =>      array(),
					"uniqueId"      =>      $producto_edit,
					"imagen"		=>      $productos_imagen,
					"finalizado"    =>		$finalizado,
					"productofinal" =>		$productoFinal
				);	
				
				$carrito->add($articulo);
			}
			
			$carrito = new Carrito();			
			$carro = $carrito->get_content();
						
			//Se agrega el producto con opciones			
			if($carro){	
				foreach($carro as $producto){
					if($producto['unique_id'] != md5($producto_edit) && !$productoFinal){
					$articulo = array(
						"id"			=>		$producto_edit,
						"cantidad"		=>		1,
						"precio"		=>		$productos_precio,
						"nombre"		=>		$productos_titulo,
						"opciones"      =>      array(),
						"uniqueId"      =>      $producto_edit,
						"imagen"		=>      $productos_imagen,
						"finalizado"    =>		false,
						"productofinal" =>		0
					);
					
					$carrito->add($articulo);
							
					}
				}
			}
			
			//Se agrega producto sin opciones
			if($carro){
				foreach($carro as $producto){
					if($producto['unique_id'] != md5($producto_edit)){
						if($productoFinal){
							$articulo = array(
								"id"			=>		$producto_edit,
								"cantidad"		=>		1,
								"precio"		=>		$productos_precio,
								"nombre"		=>		$productos_titulo,
								"uniqueId"      =>      $producto_edit,
								"imagen"		=>      $productos_imagen,
								"finalizado"    =>		true,
								"productofinal" =>		1
							);
						}
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
			";
			$carrito = new Carrito();
			$carro = $carrito->get_content();
			if($carro){	
				foreach($carro as $producto){
					$finalizado = $producto["finalizado"];
					$edicionTerminada = ($finalizado)? true : false;
				}
				if($edicionTerminada){
					echo"<select id='products' class='productosList selectProduct' name='products' onChange='showProductoSelect(this.value)'>";
				}else{
					echo"<select id='products' class='productosList selectProduct' name='products' onChange='alertaPersonalizada(this.value)'>";
				}
			}
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
			echo"
			<div style='margin-bottom:2%;'  id='carrito-compras' class='carrito-compras'>
			";
			generarCarrito();
			echo"
				</div>
			</div>
			";
		}
	}	
}

function getProductosParaSelect($prod_id){
	
	$db = callDb();
	
	$get_all_productos = 'SELECT p.titulo, p.id from productos p inner join categorias c ON c.id_producto = p.id WHERE p.activo = 1 AND c.activo = 1 GROUP BY p.titulo';
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
	
	$get_all_productos = "SELECT * from productos where productofinal = 1 AND activo = 1";
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
	<div id='submain' class='main'>
		<div style='margin-bottom:2%;' class='seccOp'>
			<span class='description'>
				<p>$prod_desc</p>			
			</span>
			<div id='opcinesCompleto'>
	";
	
	$carrito = new Carrito();
	$carro = $carrito->get_producto(md5($idProd));
	
	if($carro["finalizado"] == true){
		echo"
				<h3 style='color:blue;'>La edición del producto esta finalizada</h3>
			</div>
		</div>
		";
	}else{
		
	$contador = 1;
	$db = callDb();
	
	$get_categorias = "Select c.Id, c.Titulo FROM categorias c INNER JOIN detalles_categorias dc ON dc.cat_id = c.Id where id_producto = $idProd and c.activo = 1 and dc.activo = 1 GROUP BY c.Id, c.Titulo ORDER BY c.orden DESC";
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
			$get_subcategorias = "SELECT dc.*, C.tipo_op FROM detalles_categorias dc INNER JOIN categorias C ON C.Id = dc.cat_id WHERE dc.cat_id = $categoria_id and c.activo = 1 and dc.activo = 1";
			$run_subcategorias = mysqli_query($db, $get_subcategorias);
			
			
			while($row_subcategorias=mysqli_fetch_array($run_subcategorias)){
				$subcat_id = $row_subcategorias['id'];
				$subcat_titulo = ucfirst($row_subcategorias['titulo']);
				$subcat_imagen = $row_subcategorias['imagen'];
				$subcat_precio = $row_subcategorias['precio_adicional'];
				$cat_tipoOp = $row_subcategorias['tipo_op'];
			
			echo"
				<div class='circProd auto'>
					<a class='fancybox' rel='group' href='/admin/imagesUpload/$subcat_imagen'><img class='circProd img-circle imgSize1' src='/admin/imagesUpload/$subcat_imagen'></a>
					<h3 class='text-center subCatTitle'>$subcat_titulo</h3>
					<h4 class='text-center'>$subcat_precio</h4>
			";
			
			if($cat_tipoOp == 1){
				echo"
				<input class='inputSubcat' type='radio' name='$categoria_id' value='$subcat_id'>
				";
			}else{
				echo"
				<input class='inputSubcat' type='checkbox' name='$categoria_id' value='$subcat_id'>
				";	
			}			
				
				
			echo"	
				</div>
			";
			}
			echo"
			</center>
			<span class='description descCartel'>
			";
			
			if($contador - 1 != 1){
				echo"<span class='descCartelTexto' style='cursor:pointer; float:left; margin-left:2%;' onclick='retrocederCategoria($contador, $categoria_id)'> < Paso anterior </span>";
			}	
			
			if($contador - 1 == $totalCategorias){
				echo"<span class='descCartelTexto' style='cursor:pointer;' onclick='finalEdicion($categoria_id)'>Siguiente paso ></span>";
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
}

function generarCarrito(){
	//Seccion carrito
	echo"
		<span class='carrito'>
			<div>
				<h3 class='title pedido'>Pedido</h3>					
				<img src='/img/carrito-compras.png' />
				<a href='/producto.php?deleteShopCar=1'><img src='/img/carrito-compras-delete.png' class='borrarCarrito' /></a>
			</div>
		";
	
	//Consigo el contenido del carrito	
	$carrito = new Carrito();
	$carro = $carrito->get_content();
	$edicionTerminada = true;
	
	if(is_null($carro)){
		echo"<hr class='negro'><h2 class='sinProdTitle sinProdTitleEmptyCar'>El carrito esta vacio, por favor seleccione un <a class='linkProd' href='index.php#productos'>producto</a></h3>";
	}
	
	if($carro){	
		foreach($carro as $producto){
			$pro_tit = $producto["nombre"];
			$pro_img = $producto["imagen"];
			$finalizado = $producto["finalizado"];
			$pro_id = $producto["id"];
			$edicionTerminada = ($finalizado)? true : false;
			$producto_final = $producto["productofinal"];
			
			//Seccion cabecera del producto
			echo"
			<hr class='negro'>
				<div>
					<h2 class='titProd'>$pro_tit</h3>
					<img src='/admin/imagesUpload/$pro_img' class='img-circle imgSize2'>
					<span onclick='eliminarProducto($pro_id)' style='float:right;'>X</span>
					<span style='float:right;'>&nbsp;</span>
			";
			
			
			
			
			if(!$producto_final){
				echo"<span onclick='mostrarOcultar(111$pro_id)' style='float:right'>V</span>";
			}
					
			echo"
				</div>
			";
			
			//Seccion opciones del producto
			
			if(empty($producto["opciones"]) && !$producto_final){
				echo"		
					<center id='111$pro_id'>
						<hr class='negro'>
						<h2 class='sinProdTitle'>Aun no hay opciones seleccionadas</h3>
					</center>
				";	
			}else if(!empty($producto["opciones"])){
				if($edicionTerminada){
					echo"<center style='display:none;' id='111$pro_id'>";	
				}else{
					echo"<center id='111$pro_id'>";
				}
				
				echo"
					<hr class='negro'>	
				";
				
				foreach($producto["opciones"] as $arraySubCat){
					foreach($arraySubCat as $subCat){
						$db = callDb();
						$get_subCat = "Select dc.*, c.Titulo as categoriaTitulo FROM detalles_categorias dc left outer join categorias c ON dc.cat_id = c.Id WHERE dc.id = $subCat and c.activo = 1 and dc.activo = 1";
						$run_subCat = mysqli_query($db, $get_subCat);
					
						while($row_subCat=mysqli_fetch_array($run_subCat)){
							$sucCat_titulo = ucfirst($row_subCat['titulo']);
							$sucCat_imagen = $row_subCat['imagen'];
							$sucCat_precio = $row_subCat['precio_adicional'];
							$cat_titulo = ucfirst($row_subCat['categoriaTitulo']);
							
							echo"
								<div style='display:inline; width:auto;'>
									<div class='circProd elementCarrito' style='width:48%;'>
										<div style='display:inline'>
											<span>+</span>
											<img class='circProd img-circle imgSize3' src='/admin/imagesUpload/$sucCat_imagen'>
										</div>
										<h3 class='text-center titCatCarrito'><span>$cat_titulo</span> / $sucCat_titulo</h3>
										<h4 class='text-center'>$$sucCat_precio</h4>
									</div>
								</div>
							";						
						}
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
				
		";
		if($edicionTerminada){
			echo"
			<a href='/order.php'><button style='float:right;' type='button'>Pagar </button></a>
			<a href='/index.php#productos'><button type='button' style='margin-right:1%; float:right;' >Elegir otro producto </button> </a>
			";
		}else{
			echo"
			<a href='/#'><button style='float:right;' type='button' disabled>Pagar </button></a>
			";
			echo'
			<a onclick=alertaPersonalizada("a")><button type="button" style="margin-right:1%; float:right;" >Elegir otro producto </button> </a>
			';	
		}

		
	echo"	
		</span>
	";
}

function mensajeFinal(){
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		$opciones = array();
		
		$myString = $_GET['q'];
		$opciones = explode(',', $myString);
		$idPadre = $_GET['idPadre'];
		
		$carrito = new Carrito();
			$articulo = array(
				"id"			=>		null,
				"cantidad"		=>		1,
				"precio"		=>		null,
				"nombre"		=>		null,
				"opciones"      =>      $opciones,
				"uniqueId"      =>      intval($idPadre),
				"imagen"		=>      null,
				"finalizado"    =>		true
			);
		
		$carrito->addOption($articulo);
		
		$db = callDb();
		$get_prod_desc = "Select descripcion FROM productos WHERE id = $idPadre AND activo = 1";
		$run_qu = mysqli_query($db, $get_prod_desc);
		
		while($row_qu=mysqli_fetch_array($run_qu)){
			$productos_desc = ucfirst($row_qu['descripcion']);
			echo"
			<div style='margin-bottom:2%;' class='seccOp'>
				<span class='description'>
					<p>$productos_desc</p>			
				</span>
				<div id='opcinesCompleto'>
					<h3 style='color:blue;'>La edición del producto esta finalizada</h3>
				</div>
			</div>
			";
		}
	}
	
	echo"
		<div style='margin-bottom:2%;' id='carrito-compras' class='carrito-compras'>
		";
		generarCarrito();
		echo"
			</div>
		</div>
		";
}

function actualizarCarrito(){
	
	if(isset($_GET['q']) && !empty($_GET['q'])){
		$opciones = array();
		
		$myString = $_GET['q'];
		$opciones = explode(',', $myString);
			
		$carrito = new Carrito();
			$articulo = array(
				"id"			=>		null,
				"cantidad"		=>		1,
				"precio"		=>		null,
				"nombre"		=>		null,
				"opciones"      =>      $opciones,
				"uniqueId"      =>      intval($_GET['idPadre']),
				"imagen"		=>      null,
				"finalizado"    =>		false
			);
		
		$carrito->addOption($articulo);
		
		generarCarrito();
	}
}

function borrarUltimaOpcion(){
	$carrito = new Carrito();
		$articulo = array(
			"id"			=>		null,
			"cantidad"		=>		1,
			"precio"		=>		null,
			"nombre"		=>		null,
			"opciones"      =>      null,
			"uniqueId"      =>      intval($_GET['idPadre']),
			"imagen"		=>      null,
			"finalizado"    =>		false
		);
	
	$carrito->deleteOption($articulo);
	generarCarrito();
}

function eliminarProducto(){
	if(isset($_GET['q'])){
		$carrito = new Carrito();
		$id_enc = md5($_GET['q']);
		$carrito->remove_producto($id_enc);
		
		$carrito = new Carrito();
		$carro = $carrito->get_content();
		
		if(!empty($carro)){
			foreach($carro as $producto){
				$idPadre = $producto['id'];
			}
			
			$db = callDb();
			$get_prod_desc = "Select descripcion FROM productos WHERE id = $idPadre AND activo = 1";
			$run_qu = mysqli_query($db, $get_prod_desc);
			
			while($row_qu=mysqli_fetch_array($run_qu)){
				$productos_desc = ucfirst($row_qu['descripcion']);
				echo"
				<div style='margin-bottom:2%;' class='seccOp'>
					<span class='description'>
						<p>$productos_desc</p>			
					</span>
					<div id='opcinesCompleto'>
						<h3 style='color:blue;'>La edición del producto esta finalizada</h3>
					</div>
				</div>
				";
			}
			
			echo"
			<div style='margin-bottom:2%;' id='carrito-compras' class='carrito-compras'>
			";
			generarCarrito();
			echo"
				</div>
			</div>
			";
		}else{
			echo"
				<div style='margin-bottom:2%;' class='seccOp'>
					<span class='description'>
						<h2 class='sinProdTitle sinProdTitleEmptyCar'>Su carrito esta vacio, por favor seleccione un <a class='linkProd' href='index.php#productos'>producto</a></h2>			
					</span>
				</div>
			";
			echo"
			<div style='margin-bottom:2%;' id='carrito-compras' class='carrito-compras'>
			";
			generarCarrito();
			echo"
				</div>
			</div>
			";	
		}
				
	}
}

//Seguridad
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
?>