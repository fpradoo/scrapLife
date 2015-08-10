<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    header('Location:/admin/index.php');
} else {

?>
<!DOCTYPE html PUBLIC>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/> 
		<meta name="expires" content="-1"/>
		<meta name="description" content=" " />
		<meta name="author" content=" " />
		<meta name="keywords" content=" ">    
        <title>Secure Login: Log In</title>
		<link rel="stylesheet" type="text/css" href="/css/admin/bootstrap.css"/>
        <script type="text/JavaScript" src="/js/admin/sha512.js"></script> 
        <script type="text/JavaScript" src="/js/admin/forms.js"></script>
		<script src="/js/admin/bootstrap.js"></script>		
    </head>
    <body>
        <?php
		if(isset($_GET['error'])){
		echo"
			<p class='bg-danger'>Inicio de sesión fallido, solo cuenta con 5 intentos para iniciar sesión correctamente.</p>
		";		
		}		
		?>
		<h1>ScrapLife <small>Administrador de sitio</small></h1>
		<div style='width:60%; margin-left:20px;'>		
			<form action="includes/process_login.php" method="post" name="login_form">
				<div class='form-group'>
					<label for='titulo'>Correo electrónico:</label>
					<input type="text" name="email" class='form-control' id='titulo' required />
				</div>
				<div class='form-group'>
					<label for='password'>Contraseña:</label>
					<input class='form-control' type="password" name="password" id="password" required />
				</div>
				<input class="btn btn-default" type="button" type="button" value="Login" onclick="formhash(this.form, this.form.password);">
			</form>
		</div>
    </body>
</html>
<?php
}
?>