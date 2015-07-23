<?php

require_once'../core/init.php';	
	
function getProductos(){
		
	$db = callDb();
	
	$get_all_productos = 'Select * FROM productos order by Titulo';
	$run_productos = mysqli_query($db, $get_all_productos);
	
    while($row_productos=mysqli_fetch_array($run_productos)){
		
		$productos_id = $row_productos['id'];
		$productos_titulo = ucfirst($row_productos['titulo']);
		
		echo "
		<tr>
			<td>
				<a href='categorias.php?edit=$productos_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
			</td>
			<td>
				$productos_titulo
			</td>
			<td>
				<a href='productos.php?delete=$productos_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
			</td>
		</tr>
	";
	}	
}

function checkAndInsertProducto(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['add_submit'])){
		//Si es null
		$producto = sanitize($_POST['producto']);
		if($producto == ''){
			$errores[] .='Es necesario agregar un producto';
		}
		//Si ya existe en bd
		$sql = "SELECT * FROM productos where Titulo = '$producto'";
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errores[] .='El producto que intenta agregar ya existe';
		}
		
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "INSERT INTO productos (titulo) VALUES ('$producto')"; 
			$db->query($sql);
		}		
	}
}

function deleteProducto(){
	
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){

		$producto_delete = (int)$_GET['delete'];
		$producto_delete = sanitize($producto_delete);
		$sql = "DELETE FROM productos where id = '$producto_delete'"; 
		$db->query($sql);
		header('Location: productos.php');
	}		
}

//Crear array de errores
function mostrarErrores($errores){
	$display = '<ul class="bg-danger">';
	foreach($errores as $error){
		$display .= '<li class="text-danger">'.$error.'</li>';		
	}	
	$display .= '</ul>';
	return $display;
	
}

//Seguridad informatica
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function getCategoriaPorProductoInterno(){
	
	$db = callDb();
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		
		$producto_edit = (int)$_GET['edit'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_all_categorias_by_producto_and_interna = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'interna' ORDER BY Titulo";
		$run_categorias = mysqli_query($db, $get_all_categorias_by_producto_and_interna);
		
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$categorias_id = $row_categorias['Id'];
			$categorias_titulo = ucfirst($row_categorias['Titulo']);
			
			echo "
			<tr>
				<td>
					<a href='subcategorias.php?edit=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					$categorias_titulo
				</td>
				<td>
					<a href='categorias.php?delete=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
			</tr>
		";
		}
	}	
}

function getCategoriaPorProductoExterno(){
	
	$db = callDb();
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		
		$producto_edit = (int)$_GET['edit'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_all_categorias_by_producto_and_externa = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'externa' ORDER BY Titulo";
		$run_categorias = mysqli_query($db, $get_all_categorias_by_producto_and_externa);
		
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$categorias_id = $row_categorias['Id'];
			$categorias_titulo = ucfirst($row_categorias['Titulo']);
			
			echo "
			<tr>
				<td>
					<a href='subcategorias.php?edit=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					$categorias_titulo
				</td>
				<td>
					<a href='categorias.php?delete=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
			</tr>
		";
		}
	}	
}

function getSubcategoriasPorCategoria(){
	
	$db = callDb();
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		
		$categoria_edit = (int)$_GET['edit'];
		$categoria_edit = sanitize($categoria_edit);		
		
		$get_all_subcategorias_by_categoria = "Select * FROM detalles_categorias where cat_id = '$categoria_edit' order by Titulo";
		$run_categorias = mysqli_query($db, $get_all_subcategorias_by_categoria);
		
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$subcategorias_id = $row_categorias['id'];
			$subcategorias_titulo = ucfirst($row_categorias['titulo']);
			
			echo "
			<tr>
				<td>
					<a href='categorias.php?edit=$subcategorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					$subcategorias_titulo
				</td>
				<td>
					<a href='categorias.php?delete=$subcategorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
			</tr>
		";
		}
	}	
}

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

function changeCategoriaPorAjax(){
	$db = callDb();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_all_categorias_by_producto_and_externa = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'externa' ORDER BY Titulo";
		$run_categorias = mysqli_query($db, $get_all_categorias_by_producto_and_externa);
		
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$categorias_id = $row_categorias['Id'];
			$categorias_titulo = ucfirst($row_categorias['Titulo']);
			
			echo "
			<tr>
				<td>
					<a href='subcategorias.php?edit=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					$categorias_titulo
				</td>
				<td>
					<a href='categorias.php?delete=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
			</tr>
		";
		}
	}	
}


?>