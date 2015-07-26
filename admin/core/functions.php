<?php

require_once'../core/init.php';	
	
function getProductos(){
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){	
		$db = callDb();
		
		$get_all_productos = 'Select * FROM productos order by Titulo';
		$run_productos = mysqli_query($db, $get_all_productos);
		
		echo"
			<table class='table table-bordered table-striped table-auto text-center'>
				<thead>				
					<th class='text-center'>
						Titulo
					</th>
					<th>
						Editar
					</th>
					<th>
						Eliminar
					</th>
				</thead>
				<tbody>
		";
		
		while($row_productos=mysqli_fetch_array($run_productos)){
			
			$productos_id = $row_productos['id'];
			$productos_titulo = ucfirst($row_productos['titulo']);
			
			echo "
			<tr>
				<td>
					$productos_titulo
				</td>
				<td>
					<a href='productos.php?edit=$productos_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					<a href='productos.php?delete=$productos_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
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

function deleteProducto(){
	
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){

		$producto_delete = (int)$_GET['delete'];
		$producto_delete = sanitize($producto_delete);
		$sql = "DELETE p, c, dc FROM productos p INNER JOIN categorias c ON p.id = c.id_producto INNER JOIN detalles_categorias dc ON c.Id = dc.cat_id WHERE p.id = '$producto_delete'";
		$db->query($sql);
		header('Location: productos.php');
	}		
}

function mostrarErrores($errores){
	$display = '<ul class="bg-danger">';
	foreach($errores as $error){
		$display .= '<li class="text-danger">'.$error.'</li>';		
	}	
	$display .= '</ul>';
	return $display;
	
}

function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function getProductosParaSelect(){
	
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){	
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
}

function showEditProducto(){
	$db = callDb();
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		
		$producto_edit = (int)$_GET['edit'];
		$producto_edit = sanitize($producto_edit);
		
		$get_producto = "Select * FROM productos where id = '$producto_edit'";
		$run_producto = mysqli_query($db, $get_producto);
		
		while($row_producto=mysqli_fetch_array($run_producto)){
			
			$producto_id = $row_producto['id'];
			$producto_titulo = ucfirst($row_producto['titulo']);	
			$producto_descripcion = ucfirst($row_producto['descripcion']);
			$producto_precio = $row_producto['precio'];
			$activo = ($row_producto['activo'] == 1) ? 'checked' : '';
			
			echo"
				<h1>Editar producto </h1>
				<div style='width:60%; margin-left:20px;'>
				<form role='form' action='productos.php' method='post'>
					<div class='form-group'>
						<label for='titulo'>Titulo:</label>
						<input name='titulo' type='text' class='form-control' id='titulo' value='$producto_titulo'>
					</div>
					<div class='form-group'>
						<label for='descripcion'>Descripción:</label>
						<textarea class='form-control' rows='3' name='descripcion' id='descripcion'>$producto_descripcion</textarea> 
					</div>
					<div class='form-group'>
						<label for='precio'>Precio:</label>
						<input name='precio' type='text' class='form-control' id='precio' value='$producto_precio'>
					</div>
					<div class='checkbox'>
						<label><input name='activo' id='activo' type='checkbox' $activo> Activo</label>
					</div>
					<input type='hidden' name='producto_id' value='$producto_id'>
					<button name='edit_producto' type='submit' class='btn btn-default'>Guardar</button>
				</form>
			</div><hr>
			";
		}
	}
}

function showAddProducto(){
	if(isset($_POST['add_submit'])){
		echo"
			<h1>Editar producto </h1>
			<div style='width:60%; margin-left:20px;'>
			<form role='form' action='productos.php' method='post'>
				<div class='form-group'>
					<label for='titulo'>Titulo:</label>
					<input name='titulo' type='text' class='form-control' id='titulo' value=''>
				</div>
				<div class='form-group'>
					<label for='descripcion'>Descripción:</label>
					<textarea class='form-control' rows='3' name='descripcion' id='descripcion'></textarea> 
				</div>
				<div class='form-group'>
					<label for='precio'>Precio:</label>
					<input name='precio' type='text' class='form-control' id='precio' value=''>
				</div>
				<div class='form-group'>
					<input name='activo' id='activo' type='checkbox'> Activo
				</div>
				<button name='add_producto' type='submit' class='btn btn-default'>Guardar</button>
			</form>
		</div><hr>
		";
	}
}

function addProducto(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['add_producto'])){
		
		
		//Check datos
		$titulo_producto = sanitize($_POST['titulo']);
		if($titulo_producto == ''){
			$errores[] .='Es necesario agregarle un titulo al producto';
		}
		
		$descripcion_producto = sanitize($_POST['descripcion']);
		if($descripcion_producto == ''){
			$errores[] .='Es necesario agregarle una descripción al producto';
		}
		
		$precio_producto = sanitize($_POST['precio']);
		if($precio_producto == ''){
			$errores[] .='Es necesario agregarle un precio al producto';
		}
		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		//Si ya existe en bd
		$sql = "SELECT * FROM productos where Titulo = '$titulo_producto'";
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errores[] .='El producto que intenta agregar ya existe';
		}
		
		
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "INSERT INTO productos (titulo, descripcion, precio, activo) VALUES ('$titulo_producto', '$descripcion_producto', '$precio_producto', $activo)";
			$db->query($sql);
		}
			
	}
}

function editProducto(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['edit_producto'])){
		//Check datos
		$titulo_producto = sanitize($_POST['titulo']);
		if($titulo_producto == ''){
			$errores[] .='Es necesario agregarle un titulo al producto';
		}
		
		$descripcion_producto = sanitize($_POST['descripcion']);
		if($descripcion_producto == ''){
			$errores[] .='Es necesario agregarle una descripción al producto';
		}
		
		$precio_producto = sanitize($_POST['precio']);
		if($precio_producto == ''){
			$errores[] .='Es necesario agregarle un precio al producto';
		}
		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		$id_producto = $_POST['producto_id'];
				
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "UPDATE productos SET titulo='$titulo_producto', precio='$precio_producto', descripcion='$descripcion_producto', activo=$activo WHERE id = '$id_producto'";
			$db->query($sql);
		}		
	}
}

function botonAgregarProducto(){
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){
		echo"
		<div class='text-center'>
			<form class='form-inline' action='productos.php' method='post'>
				<div class='form-group'>			
				<input type='submit' name='add_submit' id='producto' class='btn btn-success' value='Agregar producto' />
				</div>	
			</form>
		</div><hr>
		";
	}
}

function deleteCategoria(){
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){

		$categoria_delete = (int)$_GET['delete'];
		$categoria_delete = sanitize($categoria_delete);
		$sql = "DELETE c, dc FROM categorias c INNER JOIN detalles_categorias dc ON c.Id = dc.cat_id WHERE c.Id = '$categoria_delete'"; 
		$db->query($sql);
		header('Location: categorias.php');
	}
	
}

function deleteSubcategoria(){
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){

		$subcategoria_delete = (int)$_GET['delete'];
		$subcategoria_delete = sanitize($subcategoria_delete);
		$sql = "DELETE FROM detalles_categorias where id = '$subcategoria_delete'"; 
		$db->query($sql);
		header('Location: subcategorias.php');
	}
}

function showEditCategoria(){
	$db = callDb();
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		
		$categoria_edit = (int)$_GET['edit'];
		$categoria_edit = sanitize($categoria_edit);
		
		$get_categoria = "Select * FROM categorias where id = '$categoria_edit'";
		$run_categoria = mysqli_query($db, $get_categoria);
		
		while($row_categoria=mysqli_fetch_array($run_categoria)){
			
			$categoria_id = $row_categoria['Id'];
			$categoria_titulo = ucfirst($row_categoria['Titulo']);	
			$categoria_tipo = $row_categoria['tipo_cat'];
			$categoria_operacion = $row_categoria['tipo_op'];
			$activo = ($row_categoria['activo'] == 1) ? 'checked' : '';
			
			echo"
				<h1>Editar categoria </h1>
				<div style='width:60%; margin-left:20px;'>
				<form role='form' action='categorias.php' method='post'>
					<div class='form-group'>
						<label for='titulo'>Titulo:</label>
						<input name='titulo' type='text' class='form-control' id='titulo' value='$categoria_titulo'>
					</div>
					<div class='form-group'>
						<label for='tip_cat'>Tipo de categoria:</label>
						<select name='tip_cat' id='tip_cat'>
							<option value='0'>Seleccione tipo de categoria</option>
							<option value='1'>Interna</option>
							<option value='2'>Externa</option>
						</select> 
					</div>
					<div class='form-group'>
						<label for='tip_op'>Tipo de operación:</label>
						<select name='tip_op' id='tip_op'>
							<option value='0'>Seleccione tipo de operación</option>
							<option value='1'>Simple</option>
							<option value='2'>Multiple</option>
						</select>
					</div>
					<div class='checkbox'>
						<label><input name='activo' id='activo' type='checkbox' $activo> Activo</label>
					</div>
					<input type='hidden' name='categoria_id' value='$categoria_id'>
					<button name='edit_categoria' type='submit' class='btn btn-default'>Guardar</button>
				</form>
			</div><hr>
			";
		}
		
		echo"
			<script>
				$('#tip_cat').val($categoria_tipo);
				$('#tip_op').val($categoria_operacion);
			</script>
		";
	}
}

function showAddCategoria(){
	if(isset($_POST['add_submit'])){
		echo"
			<h1>Editar producto </h1>
			<div style='width:60%; margin-left:20px;'>
			<form role='form' action='productos.php' method='post'>
				<div class='form-group'>
					<label for='titulo'>Titulo:</label>
					<input name='titulo' type='text' class='form-control' id='titulo' value=''>
				</div>
				<div class='form-group'>
					<label for='descripcion'>Descripción:</label>
					<textarea class='form-control' rows='3' name='descripcion' id='descripcion'></textarea> 
				</div>
				<div class='form-group'>
					<label for='precio'>Precio:</label>
					<input name='precio' type='text' class='form-control' id='precio' value=''>
				</div>
				<div class='form-group'>
					<input name='activo' id='activo' type='checkbox'> Activo
				</div>
				<button name='add_producto' type='submit' class='btn btn-default'>Guardar</button>
			</form>
		</div><hr>
		";
	}
}

function addCategoria(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['add_producto'])){
		
		
		//Check datos
		$titulo_producto = sanitize($_POST['titulo']);
		if($titulo_producto == ''){
			$errores[] .='Es necesario agregarle un titulo al producto';
		}
		
		$descripcion_producto = sanitize($_POST['descripcion']);
		if($descripcion_producto == ''){
			$errores[] .='Es necesario agregarle una descripción al producto';
		}
		
		$precio_producto = sanitize($_POST['precio']);
		if($precio_producto == ''){
			$errores[] .='Es necesario agregarle un precio al producto';
		}
		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		//Si ya existe en bd
		$sql = "SELECT * FROM productos where Titulo = '$titulo_producto'";
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errores[] .='El producto que intenta agregar ya existe';
		}
		
		
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "INSERT INTO productos (titulo, descripcion, precio, activo) VALUES ('$titulo_producto', '$descripcion_producto', '$precio_producto', $activo)";
			$db->query($sql);
		}
			
	}
}

function editCategoria(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['edit_categoria'])){
		//Check datos
		$titulo_categoria = sanitize($_POST['titulo']);
		if($titulo_categoria == ''){
			$errores[] .='Es necesario agregarle un titulo al producto';
		}
		
		$tipo_categoria = $_POST['tip_cat'];
		$operacion_categoria = $_POST['tip_op'];
		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		$id_categoria = $_POST['categoria_id'];
				
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "UPDATE categorias SET titulo='$titulo_categoria', tipo_cat='$tipo_categoria', tipo_op='$operacion_categoria', activo=$activo WHERE id = '$id_categoria'";
			var_dump($sql);
			$db->query($sql);
		}		
	}
}