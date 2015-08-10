<?php
	
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");
?>

<body>

	<header>
		<div class="menu">
			<div><a href="/index.php">Scrap Life</a></div>
			<div class="sep">|</div>

			<div><a href="/galeria.php">Galería</a></div>
			<div><a href="/contacto.php">Contacto</a></div>

			<div class="products">
				<ul>
					<li><a href="#"><p>Productos</p><img src="/img/dropdown.png"/></a>
						<ul>
							<?php getProductosParaNavigation(); ?>
						</ul>
					</li>
				</ul>
			</div>

			<div class="input-mail">
				<form action="#">
					<input type="text" name="mail" placeholder="Mail">	
					<input type="submit" value="Suscribite!">
				</form>
			</div>
			
			<div><a href="/admin/login.php">Log in</a></div>
			<div class="redes">
				<ul>
					<li><a href="#"><img src="/img/dropdown.png" /></a>
						<ul class="product">
							<a href="https://www.facebook.com/Scrap.Life" target="_blank"><li class="fb"></li></a>
							<a href="https://instagram.com/scrap.life/" target="_blank"><li class="itg"></li></a>
							<a href="https://www.pinterest.com/scraplifer" target="_blank"><li class="ptrst"></li></a>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</header>