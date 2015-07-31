<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';
	sec_session_start();
 
	if (login_check($mysqli) == true) {
	
	include 'includes/head.php';
	include 'includes/navigation.php';
	require_once'../core/init.php';
?>

<div class="container">
	<hr>
	<!-- Jumbotron Header -->
	<header id="headerIndexAdmin" class="jumbotron hero-spacer text-center">
		<h1>Bienvenido al administrador de ScrapLife!</h1>
		<p>Aqui podrá editar los productos, sus categorias y sus subcategorias.</p>
		<p><a class="btn btn-primary btn-large" href='productos.php'>Ver productos actuales</a>
		</p>
	</header>

	<hr>
</div>
<?php
	include 'includes/footer.php';
	} else {
    echo 'No está autorizado para acceder a esta página. Por favor, inicie su sesión';
}
?>