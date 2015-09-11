<?php
	require_once ($_SERVER['DOCUMENT_ROOT']."/mp/lib/mercadopago.php");
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
		<?PHP

			if(isset($_POST)){
				switch ($_POST["opcionDeCompra"]) {
					case "mercado":
						generarMP($_POST["nombre"], $_POST["apellido"]);
						break;
					case "payu":
						generarPayU($_POST["nombre"], $_POST["apellido"], $_POST["email"]);
						break;
					case "convenir":
						convenirConVendedor();
						break;
				}		
			}
		?>
		
	</div>
	<footer>
		<p>Copyright 2015.</p>
	</footer>	
</body>
</html>