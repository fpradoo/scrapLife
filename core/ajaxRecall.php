<?php

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
        changeSeccionSubcategoriaPorCategoria();
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
			<span>
				<h2 class='categorias tituloProducto'>Secciones</h2>
				<select id='products' class='seccionList' name='item-choise' onchange='showCategoriasDeProducto(this.value)'>
					<option selected value=''>Seleccione</option>
					<option value='2'>Interna</option>
					<option value='1'>Externa</option>
				</select>
				<span class='aclaracion'>Elija que sección del producto desea editar.</span>
			</span>
			<span id='categoria'>				
			</span>
			";
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

function showCategoriaByProduct(){
	
	$db = iniciarBD();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$tipo_seccion = (int)$_GET['q'];
		$tipo_seccion = sanitize($tipo_seccion);
		$id_prod_padre = $_GET['idpadre'];
		
		$get_categorias = "Select * FROM categorias WHERE id_producto = $id_prod_padre AND tipo_cat = $tipo_seccion";
		$run_categorias = mysqli_query($db, $get_categorias);
		
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
					<span><input type='radio' name='check' value='$subcategoria_id'><p>$subcategoria_titulo</p></span>
					";
					}else{
					echo"
					<span><input type='checkbox' name='check' value='$subcategoria_id'><p>$subcategoria_titulo</p></span>	
					";	
				}
			}
			
			echo"
				</div>
					<div class='imageOptionDiv'>
						<img class='imageOption' src='/img/product.jpg' />
					</div>
				</div>
				</span>
			";
		}	
	}
}

function changeCategoriaPorProducto(){
	
	$db = iniciarBD();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_all_categorias_by_producto_and_externa = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'externa' ORDER BY Titulo";
		$run_categorias = mysqli_query($db, $get_all_categorias_by_producto_and_externa);
		
		echo "<optgroup label = 'Externas'>";
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$categorias_id = $row_categorias['Id'];
			$categorias_titulo = ucfirst($row_categorias['Titulo']);
			
			echo "
			<option value='$categorias_id'>$categorias_titulo</option>
		";
		}
		echo "</optgroup>";
		
		$get_all_categorias_by_producto_and_externa = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'interna' ORDER BY Titulo";
		$run_categorias = mysqli_query($db, $get_all_categorias_by_producto_and_externa);
		
		echo "<optgroup label = 'Internas'>";
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$categorias_id = $row_categorias['Id'];
			$categorias_titulo = ucfirst($row_categorias['Titulo']);
			
			echo "
			<option value='$categorias_id'>$categorias_titulo</option>
		";
		}
		echo "</optgroup>";
	}	
}

function changeSeccionSubcategoriaPorCategoria(){
	$db = iniciarBD();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_all_subcategorias_by_categoria = "Select * FROM detalles_categorias where cat_id = '$producto_edit' order by Titulo";
		$run_categorias = mysqli_query($db, $get_all_subcategorias_by_categoria);
		
		echo"
			<div class='container'>
				<table class='table table-condensed table-striped table-bordered'>
				<thead>
					<tr>
						<th>
						Titulo
						</th>
						<th>
						Editar
						</th>
						<th>
						Eliminar
						</th>
					</tr>
				</thead>
				<tbody>
			";
		
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$subcategorias_id = $row_categorias['id'];
			$subcategorias_titulo = ucfirst($row_categorias['titulo']);
			
			echo "
			<tr>
				<td>
					$subcategorias_titulo
				</td>
				<td>
					<a href='subcategorias.php?edit=$subcategorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					<a href='subcategorias.php?delete=$subcategorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
			</tr>
		";
		}
		
		echo"		
			</tbody>
		</table>
		</div>
		";
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

//Seguridad
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
?>