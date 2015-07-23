<?php

changeCategoriaPorAjax();

function changeCategoriaPorAjax(){
		$server = 'localhost';
		$user = 'root';
		$pass = '';
		$bd = 'scraplife';
		
		$db = mysqli_connect("$server","$user","$pass","$bd");
	
	if(isset($_GET['q'])&&!empty($_GET['q'])){
		
		$producto_edit = (int)$_GET['q'];	
		
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