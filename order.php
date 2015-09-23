<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/classCarrito.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");	
?>

<!DOCTYPE html>
<html class="js flexbox rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent"><head>
    <title>Scrap Life - Pagá tu compra!</title>
    <link rel="shortcut icon" href="/img/scraplife-logo.jpg">
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <meta name="expires" content="-1"/>
    <meta name="description" content=" " />
    <meta name="author" content=" " />
    <meta name="keywords" content=" ">
    
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/css/productsMaquetado.css"/>
	<link rel="stylesheet" type="text/css" href="/css/order.css"/>
	<script src="/js/ajaxFunctions.js"></script> 
	<script src="/js/jquery1.11.3.js"></script> 

    <link rel="shortcut icon" href="/.ico">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/templatemo-misc.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/templatemo-main.css">

	<link rel="shortcut icon" href="images/ico/favicon.ico">
	
<body>
	<div id="home">
        <div class="site-header">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="left-header">
                                <span><i class="fa fa-phone"></i>011-4444-444</span>
                                <span><i class="fa fa-envelope"></i>mail@scrapLife.com</span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="right-header text-right">
                                <ul class="social-icons">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-google-plus"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
		</div>
	</div>
	<div id="productoCompleto">
		<div id="main" class="main productDisplay">
			<div class="productDisplay1">
				<a href="http://scraplife/index.php" title="Dreri"><img src="/img/scraplife-logo.jpg" class="img-circle img-logo"></a>
				<div class="productDisplay2">
					<h2 class="prdDisTitle">Pasos finales para completar la compra de tu producto</h2>
				</div>
			</div>
			<div class="productDisplay6">
				<a class="backUrl" href="/producto.php">Volver a la edición de productos</a>
			</div>
		</div>
		<hr>
		<div id="submain" class="main">
			<div style="margin-bottom:2%;" id="carrito-compras" class="carrito-compras">
				<span class="carrito">
					<div>
						<h3 class="title pedido">Pedido</h3>					
						<img src="/img/carrito-compras.png">
					</div>
					<hr class="negro">
					<?php
					$carrito = new Carrito();
					$carro = $carrito->get_content();
					if($carro){
						foreach($carro as $producto){
						$pro_tit = $producto["nombre"];
						$pro_img = $producto["imagen"];
						$pro_id = $producto["id"];
						
							
						//Seccion opciones del producto
						
							if(empty($producto["opciones"])){
								echo"
								<div>
									<h2 class='titProd'>$pro_tit</h2>
									<img src='/admin/imagesUpload/$pro_img' class='img-circle imgSize2'>
									<span style='float:right;'>X</span>
									<hr class='negro'>	
								</div>
								";	
							}else{
								echo"
								<div>
									<h2 class='titProd'>$pro_tit</h2>
									<img src='/admin/imagesUpload/$pro_img' class='img-circle imgSize2'>
									<span style='float:right;'>X</span>
									<span style='float:right;'>&nbsp;</span>
									<span onclick='mostrarOcultar($pro_id)' style='float:right'>V</span>
								</div>
								<center style='display:none' id='$pro_id'>
								<hr class='negro'>	
								";
									
								foreach($producto["opciones"] as $arraySubCat){
									foreach($arraySubCat as $subCat){
										$db = callDb();
										$get_subCat = "Select dc.*, c.Titulo as categoriaTitulo FROM detalles_categorias dc left outer join categorias c ON dc.cat_id = c.Id WHERE dc.id = $subCat";
										$run_subCat = mysqli_query($db, $get_subCat);
									
										while($row_subCat=mysqli_fetch_array($run_subCat)){
											$subCat_titulo = ucfirst($row_subCat['titulo']);
											$subCat_imagen = $row_subCat['imagen'];
											$subCat_precio = $row_subCat['precio_adicional'];
											$categoria_titulo = ucfirst($row_subCat['categoriaTitulo']);
											
											echo"
											<div class='circProd elementCarrito' style='width:auto;'>
												<img class='circProd img-circle imgSize3' src='/admin/imagesUpload/$subCat_imagen'>
												<h3 class='text-center titCatCarrito'>$categoria_titulo / $subCat_titulo</h3>
												<h4 class='text-center'>$$subCat_precio</h4>
											</div>
											";						
										}
									}		
								}
								echo"	
									</center>
									<hr class='negro'>
								";
							}
						}
					}
					?>
					<h5 class="total">Total: 330</h5>
					<hr class="negro clear">					
				</span>	
			</div>
			
			<?php
			if(isset($_POST["optionOrder"])){
				switch ($_POST["optionOrder"]){
					case "seleccionEnvio":
						seleccionarEnvio($_POST["nombre"], $_POST["apellido"], $_POST["tel"], $_POST["email"], $_POST["dire"], $_POST["nroDire"], $_POST["ciudad"], $_POST["codPostal"], $_POST["provincia"], $_POST["pais"]);
						break;
					case "generarResumen":
						generarResumen($_POST["nombre"], $_POST["apellido"], $_POST["tel"], $_POST["email"], $_POST["dire"], $_POST["nroDire"], $_POST["ciudad"], $_POST["codPostal"], $_POST["provincia"], $_POST["pais"], $_POST["shippingOption"]);
						break;
				}		
			}else{
				echo"
				<div style='margin-bottom:2%;' class='seccOp'>
				<span class='description'>
					<h2 class='prdDisTitleBlue'>Formulario de compra</h2>			
				</span>
				<form action='/order.php' method='POST'>
					<div id='form'>
						<div class='form-group'>
							<label for='nombre'>Nombre:</label>
							<input type='text' name='nombre' class='form-control' id='nombre' required>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido:</label>
							<input type='text' name='apellido' class='form-control' id='apellido' required>
						</div>
						<div class='form-group'>
							<label for='tel'>Telefono:</label>
							<input name='tel' type='text' class='form-control' id='tel' required>
						</div>						
						<div class='form-group'>
							<label for='email'>Email:</label>
							<input name='email' type='email' class='form-control' id='email' required>
						</div>
						<div class='form-group'>
							<label for='dire'>Nombre calle de envio:</label>
							<input name='dire' type='text' class='form-control' id='dire' required>
						</div>
						<div class='form-group'>
							<label for='nroDire'>Número calle de envio:</label>
							<input name='nroDire' type='text' class='form-control' id='nroDire' required>
						</div>
						<div class='form-group'>
							<label for='ciudad'>Ciudad:</label>
							<input name='ciudad' type='text' class='form-control' id='ciudad' required>
						</div>
						<div class='form-group'>
							<label for='codPostal'>Codigo Postal:</label>
							<input name='codPostal' type='text' class='form-control' id='codPostal' required>
						</div>
						<div class='form-group'>
							<label for='provincia'>Provincia:</label>
							<input name='provincia' type='text' class='form-control' id='provincia' required>
						</div>
						<div class='form-group'>
							<label for='pais'>País:</label>
							<input name='pais' type='text' class='form-control' id='pais' required>
						</div>						
						<div class='form-group'>
							<label>Mercado Pago</label>
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/visa@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mastercard@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/amex@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/cabal@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-naranja@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-shopping@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/banelco@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/pagofacil@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/rapipago@2x.png' alt='' title=''   />
							<img class='creditLogo' src='https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mercadopago@2x.png' alt='' title=''   />
						</div>
						<input type='hidden' value='seleccionEnvio' name='optionOrder' />
						<button type='submit' class='btn btn-default'>Aceptar</button>
					</div>
				</form>
			</div>
			";
			}
			?>
			
		</div>
	</div>
	<footer>
		<p>Copyright 2015.</p>
	</footer>	
</body>
</html>
