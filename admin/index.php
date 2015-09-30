<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php';
	sec_session_start();
 
	if (login_check($mysqli) == true) {
	
		require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/head.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/navigation.php';
?>

<div class="container">
	<hr>
	<!-- Jumbotron Header -->
	<header id="headerIndexAdmin" class="jumbotron hero-spacer text-center">
		<h1>Bienvenido al administrador de ScrapLife</h1>
		<p>Aqui podrá editar los productos, sus categorias y sus subcategorias.</p>
		<p><a class="btn btn-primary btn-large" href='productos.php'>Ver productos actuales</a>
		</p>
	</header>

	<hr>
</div>
<?php
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/footer.php';
	} else {
    echo 'No está autorizado para acceder a esta página. Por favor, inicie su sesión';
	header('Location:/admin/login.php');
}
?>