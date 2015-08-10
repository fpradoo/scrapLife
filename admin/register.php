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
        <h1>Reg�strar nuevo usuario</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li> Los nombres de usuario podr�an contener solo d�gitos, letras may�sculas, min�sculas y guiones bajos.</li>
            <li> Los correos electr�nicos deber�n tener un formato v�lido. </li>
            <li> Las contrase�as deber�n tener al menos 6 caracteres.</li>
            <li>Las contrase�as deber�n estar compuestas por:
                <ul>
                    <li> Por lo menos una letra may�scula (A-Z)</li>
                    <li> Por lo menos una letra min�scula (a-z)</li>
                    <li> Por lo menos un n�mero (0-9)</li>
                </ul>
            </li>
            <li> La contrase�a y la confirmaci�n deber�n coincidir exactamente.</li>
        </ul>
		<div style='width:60%; margin-left:20px;'>	
			<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form">
				<div class='form-group'>
					<label for='username'>Nombre de usuario:</label>
					<input type='text' name='username' id='username' class='form-control' />
				</div>
				<div class='form-group'>
					<label for='email'>Correo electr�nico:</label>
					<input type="text" name="email" id="email" class='form-control' />
				</div>
				<div class='form-group'>
					<label for='password'>Contrase�a:</label>
					<input type="password" name="password" id="password" class='form-control' />
				</div>
				<div class='form-group'>
					<label for='confirmpwd'>Confirmar contrase�a:</label>
					<input type="password" name="confirmpwd" id="confirmpwd" class='form-control' />
				</div>
				<input class="btn btn-default" type="button" value="Registrar" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" />
			</form>
		</div>
    </body>
</html>
<?php

} else {
    echo 'No est� autorizado para acceder a esta p�gina. Por favor, inicie su sesi�n';
}

?>