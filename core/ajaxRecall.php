<?php

if(isset($_GET['func'])&&!empty($_GET['func'])){
	
	$nroFuncion = (int)$_GET['func'];
	$nroFuncion = sanitize($nroFuncion);
	
	switch ($nroFuncion){
    case 1:
        showProductoSelect();
        break;
    case 2:
        changeCategoriaPorProducto();
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
				<select class='productosList' name='products' onChange='showProductoSelect(this.value)'>
			";
			
			getProductosParaSelect();
			
			echo"
				</select>
			</span>
			
				<span class='description'>
					<p>$productos_descripcion.</p>
					<img style='width:50%' src='/admin/imagesUpload/$productos_imagen' />			
				</span>
			</span>
			<div>	
				<span>
					<span>
						<h2 class='categorias tituloProducto'>Sección</h2>
						<select class='seccionList' name='item-choise'>
							<option value='1'>Item</option>
							<option value='2'>Item</option>
							<option value='3'>Item</option>
						</select>
						<span class='choise'>
						<h3 class='pri choise'>Titulo</h3>
						<div>
							<div class='radio'>
								<span><input type='radio' name='check' value='1'><p>Item</p></span>
								<span><input type='radio' name='check' value='2'><p>Otro Item</p></span>
							</div>
							<div class='imageOptionDiv'>
								<img class='imageOption' src='/img/product.jpg' />
							</div>
						</div>
						</span>
						<span class='choise'>
						<h3 class='choise'>Titulo2</h3>
						<div>
							<div class='check'>
								<span><input type='checkbox' name='check' value='1'><p>Item</p></span>
								<span><input type='checkbox' name='check' value='2'><p>Item</p></span>
								<span><input type='checkbox' name='check' value='3'><p>Otro Item</p></span> 
								<span><input type='checkbox' name='check' value='4'><p>Otro Item</p></span> 
								<span><input type='checkbox' name='check' value='5'><p>Item</p></span>
							</div>
							<div class='imageOptionDiv'>
								<img class='imageOption' src='/img/product.jpg' />
							</div>
						</div>
						</span>
					</span>
					<span class='image-description'>
					</span>
				</span>
			</div>
			";
		}
	}	
}

function getProductosParaSelect(){
	
	$db = iniciarBD();
	
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