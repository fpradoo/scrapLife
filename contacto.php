<?php 
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/navigation.php");
?>

	<div class="contact-main">
		<div>
			<span class="text">
				<h1>Contactate!</h1>
				<br><br><br>
				<p>
					Ponete en contacto con nosotros!
					<br>
					Completá el formulario con tu nombre, e-mail y asunto.
					<br><br>
					Escribí tus inquietudes y nos pondremos en contacto contigo.
				</p>
				<form>
					<input type="text" name="name" placeholder="Nombre y Apellido"><br>
					<input type="text" name="mail" placeholder="E-Mail"><br>
					<input type="text" name="subject" placeholder="Asunto"><br>
					<input type="text" name="message" placeholder="Mensaje"><br>
					<input type="submit" name="enviar" placeholder="Enviar"><br>
				</form>
				<p class="ubicacion">Nuestra ubicación:</p>
				<p>Mercado de Maschwitz - Mendoza 1731 - Ingeniero Maschwitz</p>
			</span>
		</div>
		<span class="google-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3292.720129994161!2d-58.74818499999998!3d-34.3830378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc9f8d5a4d3a9f%3A0x6cf2d38a96f11507!2sMendoza+1731%2C+B1623CSG+Ingeniero+Maschwitz%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1437359341753" frameborder="0" style="border:0" allowfullscreen></iframe>
		</span>
		<br><br><br>
		<div class="decoration">
			<img class="pri" src="img/contact-1.jpg"/>
			<img class="in" src="img/contact-2.jpg"/>
			<img class="in" src="img/contact-3.jpg"/>
			<img class="in" src="img/contact-4.jpg"/>
			<img class="ult" src="img/contact-5.jpg"/>
		</div>
	</div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php");?>