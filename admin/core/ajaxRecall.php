<?php

if(isset($_GET['func'])&&!empty($_GET['func'])){
	
	$nroFuncion = (int)$_GET['func'];
	$nroFuncion = sanitize($nroFuncion);
	
	switch ($nroFuncion){
    case 1:
        changeSeccionesCategorias();
        break;
    case 2:
        changeCategoriaPorProducto();
        break;
	case 3:
        changeSeccionSubcategoriaPorCategoria();
        break;
	}
}

function changeSeccionesCategorias(){

	$db = iniciarBD();
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];
		$producto_edit = sanitize($producto_edit);		
		
		$get_all_categorias_by_producto_and_interna = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'interna' ORDER BY Titulo";
		$run_categorias_internas = mysqli_query($db, $get_all_categorias_by_producto_and_interna);
		$get_all_categorias_by_producto_and_externa = "Select * FROM categorias c INNER JOIN tipo_cat tc ON tc.id = c.tipo_cat where id_producto = '$producto_edit' AND tc.tipo_cat = 'externa' ORDER BY Titulo";
		$run_categorias_externas = mysqli_query($db, $get_all_categorias_by_producto_and_externa);
		
		while($categoria_interna=mysqli_fetch_array($run_categorias_internas)){
			$arrayCategoriasInternas[] = $categoria_interna;	
		}
		
		while($categoria_externa=mysqli_fetch_array($run_categorias_externas)){
			$arrayCategoriasExternas[] = $categoria_externa;	
		}
		
		echo "
		<table class='table table-bordered table-striped table-auto text-center'>
			<thead>
				<th>
				Editar
				</th>
				<th>
				Eliminar
				</th>
				<th class='text-center'>
				Titulo
				</th>
			</thead>
			<tbody>
		";
		
		foreach ($arrayCategoriasInternas as $row_categoria) {
			$categorias_id = $row_categoria['Id'];
			$categorias_titulo = ucfirst($row_categoria['Titulo']);
			
			echo "
			<tr>
				<td>
					<a href='categorias.php?edit=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					<a href='categorias.php?delete=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
				<td>
					$categorias_titulo
				</td>
			</tr>
			";		
		}	
		echo"	
			</tbody>
		</table><hr>
		";
		
		echo"
		<table class='table table-bordered table-striped table-auto text-center'>
			<thead>
				<th>
				Editar
				</th>
				<th>
				Eliminar
				</th>
				<th class='text-center'>
				Titulo
				</th>
			</thead>
			<tbody>
		";
		
		foreach ($arrayCategoriasExternas as $row_categoria) {
			$categorias_id = $row_categoria['Id'];
			$categorias_titulo = ucfirst($row_categoria['Titulo']);
			
			echo "
			<tr>
				<td>
					<a href='categorias.php?edit=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					<a href='categorias.php?delete=$categorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
				<td>
					$categorias_titulo
				</td>
			</tr>
			";		
		}

		echo"
			</tbody>
		</table><hr>
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
		
		echo "<option value='0'>Seleccione categoria</option>";
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$categorias_id = $row_categorias['Id'];
			$categorias_titulo = ucfirst($row_categorias['Titulo']);
			
			echo "
			<option value='$categorias_id'>$categorias_titulo</option>
		";
		}
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
			<table class='table table-bordered table-striped table-auto text-center'>
				<thead>
					<th>
					Editar
					</th>
					<th>
					Eliminar
					</th>
					<th class='text-center'>
					Titulo
					</th>
				</thead>
				<tbody>
			";
		
		while($row_categorias=mysqli_fetch_array($run_categorias)){
			
			$subcategorias_id = $row_categorias['id'];
			$subcategorias_titulo = ucfirst($row_categorias['titulo']);
			
			echo "
			<tr>
				<td>
					<a href='subcategorias.php?edit=$subcategorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					<a href='subcategorias.php?delete=$subcategorias_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>
				<td>
					$subcategorias_titulo
				</td>
			</tr>
		";
		}
		
		echo"		
			</tbody>
		</table><hr>
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