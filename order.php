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
					<div>
						<h2 class="titProd">Albumés</h2>
						<img src="/admin/imagesUpload/1253369367805_f.jpg" class="img-circle imgSize2">
						<span onclick='mostrarOcultar(9);' style='float:right;'>V<span>
						<span style='float:right;'>&nbsp;<span>
						<span style='float:right;'>X<span>
					</div>				
					<center style='display:none' id="9">
						<hr class="negro">	
						<div class="circProd elementCarrito">
							<img class="circProd img-circle imgSize3" src="/admin/imagesUpload/producto3.png">
							<h3 class="text-center titCatCarrito">10 x 15</h3>
							<h4 class="text-center">45</h4>
						</div>
						<div class="circProd elementCarrito">
							<img class="circProd img-circle imgSize3" src="/admin/imagesUpload/producto3.png">
							<h3 class="text-center titCatCarrito">Anillada</h3>
							<h4 class="text-center">23</h4>
						</div>
					</center>
					<hr class="negro">
					<div>
						<h2 class="titProd">Albumés</h2>
						<img src="/admin/imagesUpload/1253369367805_f.jpg" class="img-circle imgSize2">
						<span onclick='mostrarOcultar(10);' style='float:right;'>V<span>
						<span style='float:right;'>&nbsp;<span>
						<span style='float:right;'>X<span>
					</div>				
					<center style='display:none' id="10">
						<hr class="negro">	
						<div class="circProd elementCarrito">
							<img class="circProd img-circle imgSize3" src="/admin/imagesUpload/producto3.png">
							<h3 class="text-center titCatCarrito">10 x 15</h3>
							<h4 class="text-center">45</h4>
						</div>
						<div class="circProd elementCarrito">
							<img class="circProd img-circle imgSize3" src="/admin/imagesUpload/producto3.png">
							<h3 class="text-center titCatCarrito">Anillada</h3>
							<h4 class="text-center">23</h4>
						</div>
					</center>
					<hr class="negro clear">
					<h5 class="total">Total: 330</h5>
					<hr class="negro clear">					
				</span>	
			</div>
			<div style="margin-bottom:2%;" class="seccOp">
				<span class="description">
					<h2 class="prdDisTitleBlue">Formulario de compra</h2>			
				</span>
				<form action='/crearCompra.php' method='POST'>
					<div id='form'>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" name='nombre' class="form-control" id="nombre" required>
						</div>
						<div class="form-group">
							<label for="apellido">Apellido:</label>
							<input type="text" name='apellido' class="form-control" id="apellido" required>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input name="email" type="email" class="form-control" id="email" required>
						</div>
						<div class="radio">
							<label><input name="opcionDeCompra" type="radio" value="mercado" required>Mercado Pago</label>
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/visa@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mastercard@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/amex@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/cabal@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-naranja@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-shopping@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/banelco@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/pagofacil@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/rapipago@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mercadopago@2x.png" alt="" title=""   />
						</div>
						<div class="radio">
							<label><input name="opcionDeCompra" type="radio" value="payu" required>Payu</label>
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/visa@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mastercard@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/amex@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/cabal@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-naranja@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-shopping@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/pagofacil@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/rapipago@2x.png" alt="" title=""   />
							<img class="creditLogo" src="https://d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/dineromail@2x.png" alt="" title=""   />
						</div>
						<div class="radio">
							<label><input name="opcionDeCompra" type="radio" value="convenir" required>A convenir con un vendedor</label>
						</div>
						<button type="submit" class="btn btn-default">Aceptar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<footer>
		<p>Copyright 2015.</p>
	</footer>	
</body>
</html>
