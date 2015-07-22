<?php

require_once'../core/init.php';	
	
function getCategorias(){
		
	$db = callDb();
	
	$get_all_categorias = 'Select * FROM productos order by Titulo';
	$run_categorias = mysqli_query($db, $get_all_categorias);
	
    while($row_categorias=mysqli_fetch_array($run_categorias)){
		
		$categoria_id = $row_categorias['id'];
		$categoria_titulo = $row_categorias['titulo'];
		
		echo "
		<tr>
			<td>
				<a href='categorias.php?edit=$categoria_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-pencil'></span></a>
			</td>
			<td>
				$categoria_titulo
			</td>
			<td>
				<a href='categorias.php?delete=$categoria_id' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-remove-sign'></span></a>
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
		$producto = sanitize($_POST['categoria']);
		if($producto == ''){
			$errores[] .='Es necesario agregar una categoria';
		}
		//Si ya existe en bd
		$sql = "SELECT * FROM productos where Titulo = '$producto'";
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errores[] .='El registro que intenta agregar ya existe';
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
	
	if(isset($_GET['edit'])&&!empty($_GET['edit'])){
		//Si es null
		$producto_edit = (int)$_GET['edit'];
		$producto_edit = sanitize($producto_edit);
		$sql2 = "SELECT * FROM productos WHERE id = '$producto_edit'"; 
		$edit_result = $db->query($sql2);
		$eProd = mysqli_fetch_assoc($edit_result);
		$db->query($sql);
		header('Location: categorias.php');
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


?>