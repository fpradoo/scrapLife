<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/db_connect.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanear y validar los datos provistos.
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // No es un correo electr�nico v�lido.
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // La contrase�a con hash deber� ser de 128 caracteres.
        // De lo contrario, algo muy raro habr� sucedido. 
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // La validez del nombre de usuario y de la contrase�a ha sido verificada en el cliente.
    // Esto ser� suficiente, ya que nadie se beneficiar� de
    // violar estas reglas.
    //
 
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo electr�nico existente.  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ya existe otro usuario con este correo electr�nico.
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
 
    // Verifica el nombre de usuario existente. 
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // Ya existe otro usuario con este nombre de usuario.
                        $error_msg .= '<p class="error">A user with this username already exists</p>';
                        $stmt->close();
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 
    // Pendiente: 
    // Tambi�n habr� que tener en cuenta la situaci�n en la que el usuario no tenga
    // derechos para registrarse, al verificar qu� tipo de usuario intenta
    // realizar la operaci�n.
 
    if (empty($error_msg)) {
        // Crear una sal aleatoria.
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Crea una contrase�a con sal. 
        $password = hash('sha512', $password . $random_salt);
 
        // Inserta el nuevo usuario a la base de datos.  
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Ejecuta la consulta preparada.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location:/admin/index.php');
    }
}