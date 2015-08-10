<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';	

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
		<li><a href='/producto.php'>$productos_titulo</a></li>
		";
	}	
}

function getProductosParaSelectFormularioNuevo(){
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
			$imagen = $row_producto['imagen'];
			
			echo"
				<h1>Editar producto </h1>
				<div style='width:60%; margin-left:20px;'>
				<form role='form' action='productos.php' method='post' enctype='multipart/form-data'>
					<div class='form-group'>
						<label for='titulo'>Titulo:</label>
						<input name='titulo' type='text' class='form-control' id='titulo' value='$producto_titulo' required>
					</div>
					<div class='form-group'>
						<label for='descripcion'>Descripción:</label>
						<textarea class='form-control' rows='3' name='descripcion' id='descripcion' required>$producto_descripcion</textarea> 
					</div>
					<div class='form-group'>
						<label for='precio'>Precio:</label>
						<input name='precio' type='number' class='form-control' id='precio' value='$producto_precio' required>
					</div>
					<div class='form-group'>
						<input class='file' type='file' name='fileToUpload' id='fileToUpload'>
						<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Ver imagen actual</button>
					</div>
					<div class='checkbox'>
						<label><input name='activo' id='activo' type='checkbox' $activo> Activo</label>
					</div>
					<input type='hidden' name='producto_id' value='$producto_id'>
					<button name='edit_producto' type='submit' class='btn btn-default'>Guardar</button>
				</form>
			</div>
			<div class='modal fade' id='myModal' role='dialog'>
				<div class='modal-dialog'>
					<img src='/admin/imagesUpload/$imagen' class='img-thumbnail'>
				</div>
			</div>
			";
		}
	}
}

function showAddProducto(){
	if(isset($_POST['add_submit'])){
		echo"
			<h1>Editar producto </h1>
			<div style='width:60%; margin-left:20px;'>
			<form role='form' action='productos.php' method='post' enctype='multipart/form-data'>
				<div class='form-group'>
					<label for='titulo'>Titulo:</label>
					<input name='titulo' type='text' class='form-control' id='titulo' required>
				</div>
				<div class='form-group'>
					<label for='descripcion'>Descripción:</label>
					<textarea class='form-control' rows='3' name='descripcion' id='descripcion' required></textarea> 
				</div>
				<div class='form-group'>
					<label for='precio'>Precio:</label>
					<input name='precio' type='number' class='form-control' id='precio' required>
				</div>
				<div class='form-group'>
					<input class='file' type='file' name='fileToUpload' id='fileToUpload' required>
				</div>
				<div class='form-group'>
					<input name='activo' id='activo' type='checkbox'> Activo
				</div>
				<button name='add_producto' type='submit' class='btn btn-default'>Guardar</button>
			</form>
		</div>
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
		
		//Gestion de la imagen
		$target_dir = "D:/www/scrapLife/admin/imagesUpload/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$errores[] .='El archivo que intenta subir no es una imagen';
				$uploadOk = 0;
			}
		}
				
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$errores[] .='La imagen que intenta subir es muy grande';
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$errores[] .='Los unicos formatos permitidos son jpg, png, jpeg y gif';
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 1) {
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		}
		
		$nombreDeLaImagen = basename($_FILES["fileToUpload"]["name"]);
		
		
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "INSERT INTO productos (titulo, descripcion, precio, imagen, activo ) VALUES ('$titulo_producto', '$descripcion_producto', '$precio_producto', '$nombreDeLaImagen', $activo)";
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
		$precio_producto = sanitize($_POST['precio']);
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		$id_producto = $_POST['producto_id'];
		
		$nombreDeLaImagen = '';
		if($_FILES["fileToUpload"]["name"] != ''){
			//Gestion de la imagen
			$target_dir = "D:/www/scrapLife/admin/imagesUpload/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$errores[] .='El archivo que intenta subir no es una imagen';
					$uploadOk = 0;
				}
			}
						
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				$errores[] .='La imagen que intenta subir es muy grande';
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$errores[] .='Los unicos formatos permitidos son jpg, png, jpeg y gif';
				$errores[] .= $imageFileType;
				$errores[] .= $_FILES["fileToUpload"]["name"];
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 1) {
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			}
			
			$nombreDeLaImagen = basename($_FILES["fileToUpload"]["name"]);
		}
				
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
				if($nombreDeLaImagen != ''){
					$sql = "UPDATE productos SET titulo='$titulo_producto', precio='$precio_producto', descripcion='$descripcion_producto', imagen='$nombreDeLaImagen', activo=$activo WHERE id = '$id_producto'";
				}else{
					$sql = "UPDATE productos SET titulo='$titulo_producto', precio='$precio_producto', descripcion='$descripcion_producto', activo=$activo WHERE id = '$id_producto'";
				}
			
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
		</div>
		";
	}
}

function deleteCategoria(){
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){

		$categoria_delete = (int)$_GET['delete'];
		$categoria_delete = sanitize($categoria_delete);
		$sqlSelect = "SELECT * FROM categorias WHERE Id = '$categoria_delete'";
		$run_productos = mysqli_query($db, $sqlSelect);
		while($row_productos=mysqli_fetch_array($run_productos)){	
			$productos_id_padre = $row_productos['id_producto'];
		}
		
		$sql = "DELETE c, dc FROM categorias c LEFT OUTER JOIN detalles_categorias dc ON c.Id = dc.cat_id WHERE c.Id = '$categoria_delete'"; 
		$db->query($sql);		
		
		echo"
		<script>
			showSeccionesCategorias($productos_id_padre);
		</script>
		";
	}
	
}

function deleteSubcategoria(){
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){
		
		$subcategoria_delete = (int)$_GET['delete'];
		$subcategoria_delete = sanitize($subcategoria_delete);
		
		$get_imagen = "Select imagen FROM detalles_categorias where id = '$subcategoria_delete'";
		$run_imagen = mysqli_query($db, $get_imagen);
		
		while($row_imagen=mysqli_fetch_array($run_imagen)){
			$target_dir = "D:/www/scrapLife/admin/imagesUpload/";
			$target_file = $target_dir . $row_imagen['imagen'];
			unlink($target_file);
		}
		
		$sqlSelect = "SELECT * FROM detalles_categorias WHERE id = '$subcategoria_delete'";
		$run_productos = mysqli_query($db, $sqlSelect);
		while($row_productos=mysqli_fetch_array($run_productos)){	
			$categoria_id_padre = $row_productos['cat_id'];
		}
		
		$sql = "DELETE FROM detalles_categorias where id = '$subcategoria_delete'"; 
		$db->query($sql);
		echo"
		<script>
			showSeccionSubcategorias($categoria_id_padre);
		</script>
		";	
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
						<input name='titulo' type='text' class='form-control' id='titulo' value='$categoria_titulo' required>
					</div>
					<div class='form-group'>
						<label for='tip_cat'>Tipo de categoria:</label>
						<select name='tip_cat' id='tip_cat' required>
							<option value=''>Seleccione</option>
							<option value='1'>Externa</option>
							<option value='2'>Interna</option>
						</select> 
					</div>
					<div class='form-group'>
						<label for='tip_op'>Tipo de operación:</label>
						<select name='tip_op' id='tip_op' required>
							<option value=''>Seleccione</option>
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
			</div>
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
		<h1>Agregar categoria </h1>
		<div style='width:60%; margin-left:20px;'>
			<form role='form' action='categorias.php' method='post'>
				<div class='form-group'>
					<label for='id_producto'>Pertenece al producto:</label>
					<select name='id_producto' id='id_producto' required>
						<option value=''>Seleccione</option>
		";
		getProductosParaSelectFormularioNuevo();
		
		echo"
					</select> 
				</div>
				<div class='form-group'>
					<label for='titulo'>Titulo:</label>
					<input name='titulo' type='text' class='form-control' id='titulo' value='' required>
				</div>
				<div class='form-group'>
					<label for='tip_cat'>Tipo de categoria:</label>
					<select name='tip_cat' id='tip_cat' required>
						<option value=''>Seleccione</option>
						<option value='1'>Externa</option>
						<option value='2'>Interna</option>
					</select> 
				</div>
				<div class='form-group'>
					<label for='tip_op'>Tipo de operación:</label>
					<select name='tip_op' id='tip_op' required>
						<option value=''>Seleccione</option>
						<option value='1'>Simple</option>
						<option value='2'>Multiple</option>
					</select>
				</div>
				
				<div class='checkbox'>
					<label><input name='activo' id='activo' type='checkbox'> Activo</label>
				</div>
				<input type='hidden' name='categoria_id' value=''>
				<button name='add_categoria' type='submit' class='btn btn-default'>Guardar</button>
			</form>
		</div>
		";
	}
}

function addCategoria(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['add_categoria'])){
		//Check datos
		$titulo_categoria = sanitize($_POST['titulo']);
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		$id_producto_padre = $_POST['id_producto'];
		$tipo_cat = $_POST['tip_cat'];
		$tipo_op = $_POST['tip_op'];		
				
		$sql = "INSERT INTO categorias (Titulo, tipo_cat, tipo_op, id_producto, activo) VALUES ('$titulo_categoria', '$tipo_cat', '$tipo_op', '$id_producto_padre', $activo)";
		$db->query($sql);

		echo"
		<script>
			showSeccionesCategorias($id_producto_padre);
		</script>
		";		
	}
}

function editCategoria(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['edit_categoria'])){
		$id_categoria = $_POST['categoria_id'];
		$sqlSelect = "SELECT * FROM categorias WHERE Id = '$id_categoria'";
		$run_productos = mysqli_query($db, $sqlSelect);
		while($row_productos=mysqli_fetch_array($run_productos)){	
			$productos_id_padre = $row_productos['id_producto'];
		}
		
		//Check datos
		$titulo_categoria = sanitize($_POST['titulo']);
		$tipo_categoria = $_POST['tip_cat'];
		$operacion_categoria = $_POST['tip_op'];		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		
		$sql = "UPDATE categorias SET titulo='$titulo_categoria', tipo_cat='$tipo_categoria', tipo_op='$operacion_categoria', activo=$activo WHERE id = '$id_categoria'";
		$db->query($sql);
		
		echo"
		<script>
			showSeccionesCategorias($productos_id_padre);
		</script>
		";		
	}
}

function botonAgregarCategoria(){
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){
		echo"
		<div class='text-center'>
			<form class='form-inline' action='categorias.php' method='post'>
				<div class='form-group'>			
				<input type='submit' name='add_submit' id='categoria' class='btn btn-success' value='Agregar categoria' />
				</div>	
			</form>
		</div>
		";
	}
}

function showSelectCategorias(){
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){
		echo"
		<div class='text-center'>
			<h2 class='text-center'>Categorias</h2>
			<select id='selectCategoriaByProducto' onchange='showSeccionesCategorias(this.value)'>
				<option>Seleccionar producto</option>
		";
		
		getProductosParaSelect();

		echo"
			</select>
		</div>
		";	
	}
}

function getSelectsSubcategorias(){
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){

	echo"
		<h2 class='text-center'>Subcategorias</h2>
		<div class='text-center'>
		<select onchange='showCategoriasEnSelect(this.value)'>
			<option>Seleccionar producto</option>
				
	";
	
	getProductosParaSelect();
	
	echo"
	</select>
		<select class='topSelects' id='categoriasPorProducto' onchange='showSeccionSubcategorias(this.value)'>
			<option>Seleccionar categoria</option>
		</select>
		</div>
		
	";
	}
}

function getSelectSubcategoriaParaAdd(){
	
	echo"
		<div class='form-group'>
		<select onchange='showCategoriasEnSelect(this.value)' required>
			<option value=''>Seleccionar producto</option>
	";
	
	getProductosParaSelectFormularioNuevo();
	
	echo"
		</select>
		<select name='categoria' id='categoriasPorProducto' required>
			<option value=''>Seleccionar categoria</option>
		</select>
	</div>
	";	
}

function botonAgregarSubcategoria(){
	if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){
		echo"
		<div class='text-center'>
			<form class='form-inline' action='subcategorias.php' method='post'>
				<div class='form-group'>			
				<input type='submit' name='add_submit' id='subcategoria' class='btn btn-success' value='Agregar Subcategoria' />
				</div>	
			</form>
		</div>
		";
	}
}

function showEditSubcategoria(){
	$db = callDb();
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		
		$subcategoria_edit = (int)$_GET['edit'];
		$subcategoria_edit = sanitize($subcategoria_edit);
		
		$get_subcategoria = "Select * FROM detalles_categorias where id = '$subcategoria_edit'";
		$run_subcategoria = mysqli_query($db, $get_subcategoria);
		
		while($row_subcategoria=mysqli_fetch_array($run_subcategoria)){
			
			$subcategoria_id = $row_subcategoria['id'];
			$subcategoria_titulo = ucfirst($row_subcategoria['titulo']);	
			$subcategoria_precio = $row_subcategoria['precio_adicional'];
			$activo = ($row_subcategoria['activo'] == 1) ? 'checked' : '';
			$imagen = $row_subcategoria['imagen'];
			
			echo"
				<h1>Editar subcategoria </h1>
				<div style='width:60%; margin-left:20px;'>
				<form role='form' action='subcategorias.php' method='post' enctype='multipart/form-data'>
					<div class='form-group'>
						<label for='titulo'>Titulo:</label>
						<input name='titulo' type='text' class='form-control' id='titulo' value='$subcategoria_titulo' required>
					</div>
					<div class='form-group'>
						<label for='precio'>Precio:</label>
						<input name='precio' type='number' class='form-control' id='precio' value='$subcategoria_precio' required>
					</div>
					<div class='form-group'>
						<input class='file' type='file' name='fileToUpload' id='fileToUpload'>
						<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Ver imagen actual</button>
					</div>
					<div class='checkbox'>
						<label><input name='activo' id='activo' type='checkbox' $activo> Activo</label>
					</div>
					<input type='hidden' name='subcategoria_id' value='$subcategoria_id'>
					<button name='edit_subcategoria' type='submit' class='btn btn-default'>Guardar</button>
				</form>
			</div>
			<div class='modal fade' id='myModal' role='dialog'>
				<div class='modal-dialog'>
					<img src='/admin/imagesUpload/$imagen' class='img-thumbnail'>
				</div>
			</div>
			";
		}
	}
}

function showAddSubcategoria(){
	
	if(isset($_POST['add_submit'])){
		echo"
			<h1>Agregar subcategoria </h1>
			<div style='width:60%; margin-left:20px;'>
			<form role='form' action='subcategorias.php' method='post' enctype='multipart/form-data'>
		";	
		
		getSelectSubcategoriaParaAdd();
		
		echo"
				<div class='form-group'>
					<label for='titulo'>Titulo:</label>
					<input name='titulo' type='text' class='form-control' id='titulo' value='' required>
				</div>
				<div class='form-group'>
					<label for='precio'>Precio:</label>
					<input name='precio' type='number' class='form-control' id='precio' value='' required>
				</div>
				<div class='form-group'>
					<input class='file' type='file' name='fileToUpload' id='fileToUpload' required>
				</div>
				<div class='checkbox'>
					<label><input name='activo' id='activo' type='checkbox' > Activo</label>
				</div>
				<input type='hidden' name='categoria_id' value=''>
				<button name='add_subcategoria' type='submit' class='btn btn-default'>Guardar</button>
			</form>
		</div>
		";
	}
}

function addSubcategoria(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['add_subcategoria'])){
		//Check datos
		$titulo_subcategoria = sanitize($_POST['titulo']);
		if($titulo_subcategoria == ''){
			$errores[] .='Es necesario agregarle un titulo a la subcategoria';
		}
		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		$id_categoria_padre = $_POST['categoria'];
		$precio = $_POST['precio'];
		
		//Si ya existe en bd
		$sql = "SELECT * FROM categorias where Titulo = '$titulo_subcategoria'";
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errores[] .='La subcategoria que intenta agregar ya existe';
		}
		
		//Gestion de la imagen
		$target_dir = "D:/www/scrapLife/admin/imagesUpload/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$errores[] .='El archivo que intenta subir no es una imagen';
				$uploadOk = 0;
			}
		}
		
		// Check if file already exists
		if (file_exists($target_file)) {
			$errores[] .='La imagen que intenta subir ya existe';
			$uploadOk = 0;
		} 
		
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$errores[] .='La imagen que intenta subir es muy grande';
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$errores[] .='Los unicos formatos permitidos son jpg, png, jpeg y gif';
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 1) {
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		}
		
		$nombreDeLaImagen = basename($_FILES["fileToUpload"]["name"]);
		
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			$sql = "INSERT INTO detalles_categorias (titulo, cat_id, precio_adicional, imagen, activo) VALUES ('$titulo_subcategoria', '$id_categoria_padre', '$precio', '$nombreDeLaImagen', $activo)";
			$db->query($sql);
		}
		echo"
		<script>
			showSeccionSubcategorias($id_categoria_padre);
		</script>
		";		
	}
}

function editSubcategoria(){
	
	$db = callDb();
	
	$errores = array();
	if(isset($_POST['edit_subcategoria'])){
		//Check datos
		$titulo_subcategoria = sanitize($_POST['titulo']);
		if($titulo_subcategoria == ''){
			$errores[] .='Es necesario agregarle un titulo a la categoria';
		}
		
		$precio = $_POST['precio'];
		
		(int)$activo = (isset($_POST['activo'])) ? '1' : '0';
		
		$id_subcategoria = $_POST['subcategoria_id'];
		$nombreDeLaImagen = '';
		if($_FILES["fileToUpload"]["name"] != ''){
			//Gestion de la imagen
			$target_dir = "D:/www/scrapLife/admin/imagesUpload/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$errores[] .='El archivo que intenta subir no es una imagen';
					$uploadOk = 0;
				}
			}
			
			// Check if file already exists
			if (file_exists($target_file)) {
				$errores[] .='La imagen que intenta subir ya existe';
				$uploadOk = 0;
			} 
			
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				$errores[] .='La imagen que intenta subir es muy grande';
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$errores[] .='Los unicos formatos permitidos son jpg, png, jpeg y gif';
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 1) {
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			}
			
			$nombreDeLaImagen = basename($_FILES["fileToUpload"]["name"]);
		}
		
		$sqlSelect = "SELECT * FROM detalles_categorias WHERE id = '$id_subcategoria'";
		$run_productos = mysqli_query($db, $sqlSelect);
		while($row_productos=mysqli_fetch_array($run_productos)){	
			$categoria_id_padre = $row_productos['cat_id'];
		}
		
		if(!empty($errores)){
			echo mostrarErrores($errores);
			}else{
			if($nombreDeLaImagen != ''){	
				$sql = "UPDATE detalles_categorias SET titulo='$titulo_subcategoria', precio_adicional='$precio', imagen='$nombreDeLaImagen', activo=$activo WHERE id = '$id_subcategoria'";
			}else{
				$sql = "UPDATE detalles_categorias SET titulo='$titulo_subcategoria', precio_adicional='$precio', activo=$activo WHERE id = '$id_subcategoria'";
			}
			$db->query($sql);
		}
			
		echo"
		<script>
			showSeccionSubcategorias($categoria_id_padre);
		</script>
		";	
	}
}

function getUsuarios(){
	//if(!isset($_GET['edit']) && !isset($_POST['add_submit'])){	
		$db = callDb();
		
		$get_all_usuarios = 'Select * FROM members';
		$run_usuarios = mysqli_query($db, $get_all_usuarios);
		
		echo"
			<h2 class='text-center'>Usuarios</h2>
			<div class='container'>			            
			  <table class='table table-condensed table-striped table-bordered'>
				<thead>
				  <tr>
					<th>Mail</th>
					<th>Editar</th>
					<th>Borrar</th>
				  </tr>
				</thead>
				<tbody>
			";
		
		while($row_usuarios=mysqli_fetch_array($run_usuarios)){
			
			$usuarios_id = $row_usuarios['id'];
			$usuarios_mail= ucfirst($row_usuarios['email']);
			
			echo "
			<tr>
				<td>
					$usuarios_mail
				</td>
				<td>
					<a href='usuarios.php?edit=$usuarios_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
				</td>
				<td>
					<a href='usuarios.php?delete=$usuarios_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
				</td>			
			</tr>
			";
		}

		echo"
				</tbody>
			  </table>
			</div>
		";
	//}
}

function deleteUsuario(){
	$db = callDb();
	
	if(isset($_GET['delete'])&&!empty($_GET['delete'])){
		$usuario_delete = (int)$_GET['delete'];
		$usuario_delete = sanitize($usuario_delete);
		$sql = "DELETE FROM members where id = '$usuario_delete'"; 
		$db->query($sql);
		header('Location: usuarios.php');
	}
}

?>