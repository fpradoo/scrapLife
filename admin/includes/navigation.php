<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php';;
	sec_session_start();
?>
<body>
<!--<header>
	<div class="menu">
		<div><a href="/admin/index.php">Scrap Life ADMIN</a></div>
		<div class="sep">|</div>

		<div><a href="/admin/productos.php">Productos</a></div>
		<div><a href="/admin/categorias.php">Categorias</a></div>
		<div><a href="/admin/subcategorias.php">Subcategorias</a></div>
		<div><a href="/admin/register.php">Usuarios</a></div>
		<div><a href="/admin/includes/logout.php">Cerrar sesion</a></div>
		
	</div>
</header>-->

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/admin/index.php">ScrapLife</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/admin/productos.php">Productos</a></li>
        <li><a href="/admin/categorias.php">Categorias</a></li>
		<li><a href="/admin/subcategorias.php">Subcategorias</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/usuarios.php">Ver usuarios</a></li>
            <li><a href="/admin/register.php">Nuevos usuarioss</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="userActual"><?php echo $_SESSION['username'] ?></li>
		<li><a href="/admin/includes/logout.php">Cerrar sesión</a></li>
	  </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>