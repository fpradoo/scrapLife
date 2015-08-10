<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/register.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php';
sec_session_start();
 
if (login_check($mysqli) == true) {

?>
<!DOCTYPE html PUBLIC>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
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
        <h1>Regístrar nuevo usuario</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li> Los nombres de usuario podrían contener solo dígitos, letras mayúsculas, minúsculas y guiones bajos.</li>
            <li> Los correos electrónicos deberán tener un formato válido. </li>
            <li> Las contraseñas deberán tener al menos 6 caracteres.</li>
            <li>Las contraseñas deberán estar compuestas por:
                <ul>
                    <li> Por lo menos una letra mayúscula (A-Z)</li>
                    <li> Por lo menos una letra minúscula (a-z)</li>
                    <li> Por lo menos un número (0-9)</li>
                </ul>
            </li>
            <li> La contraseña y la confirmación deberán coincidir exactamente.</li>
        </ul>
		<div style='width:60%; margin-left:20px;'>	
			<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
				<div class='form-group'>
					<label for='username'>Nombre de usuario:</label>
					<input type='text' name='username' id='username' class='form-control' />
				</div>
				<div class='form-group'>
					<label for='email'>Correo electrónico:</label>
					<input type="text" name="email" id="email" class='form-control' />
				</div>
				<div class='form-group'>
					<label for='password'>Contraseña:</label>
					<input type="password" name="password" id="password" class='form-control' />
				</div>
				<div class='form-group'>
					<label for='confirmpwd'>Confirmar contraseña:</label>
					<input type="password" name="confirmpwd" id="confirmpwd" class='form-control' />
				</div>
				<input class="btn btn-default" type="button" value="Registrar" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" />
			</form>
		</div>
    </body>
</html>
<?php

} else {
    echo 'No está autorizado para acceder a esta página. Por favor, inicie su sesión';
}

?>