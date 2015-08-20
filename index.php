<?php  include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");     ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <title>ScrapLife - ScrapBooking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <meta charset="UTF-8">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- CSS Bootstrap & Custom -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/templatemo-misc.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo-main.css">

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/modernizr.js"></script>
	<script>
		function OpenInNewTab(url) {
		  window.location = url;
		}
		
		$('#prod').on('click touchstart', function(){
			window.location = '/producto.php';
			alert(a);
		});
		
		$("#prod").on("taphold",function(){
		  window.location = '/producto.php';
		  alert(a);
		});
	</script>
	
	
</head>
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
                            </div> <!-- /.left-header -->
                        </div> <!-- /.col-md-6 -->
                        <div class="col-md-6 col-sm-6">
                            <div class="right-header text-right">
                                <ul class="social-icons">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-google-plus"></a></li>
                                </ul>
                            </div> <!-- /.left-header -->
                        </div> <!-- /.col-md-6 -->
                    </div> 
                </div> 
            </div> 
            <div class="main-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="logo">
                                <a href="/index.php#home" title="Dreri"><img src="/img/scraplife-logo.jpg" class="img-circle"></a>
                            </div> 
                        </div> 
                        <div class="col-md-8 col-sm-8 col-xs-6">
                            <div class="menu text-right hidden-sm hidden-xs">
                                <ul>
                                    <li><a href="#home">Home</a></li>
									<li><a class="pointer" id='prod' onclick="OpenInNewTab('/producto.php')" onmouseup="OpenInNewTab('/producto.php')">Productos</a></li>
									<li><a href="#services">Servicios</a></li>
                                    <li><a href="#portfolio">Galeria</a></li>
                                    <li><a href="#about">Sobre nosotros</a></li>
                                    <li><a href="#contact">Contacto</a></li>
                                </ul>
                            </div> 
                        </div> 
                    </div> 
                    <div class="responsive-menu text-right visible-xs visible-sm">
                        <a href="#" class="toggle-menu fa fa-bars"></a>
                        <div class="menu">
                            <ul>
                                <li><a href="#home">Home</a></li>
								<li><a href="/producto.php" target="_blank">Productos</a></li>
								<li><a href="#services">Servicios</a></li>
								<li><a href="#portfolio">Galeria</a></li>
								<li><a href="#about">Sobre nosotros</a></li>
								<li><a href="#contact">Contacto</a></li>
                            </ul>
                        </div> <!-- /.menu -->
                    </div> <!-- /.responsive-menu -->
                </div> <!-- /.container -->
            </div> <!-- /.header -->
        </div> <!-- /.site-header -->
    </div> <!-- /#home -->

    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="images/banner01.jpg" alt="">
                <div class="flex-caption">
                    <h2>Paso 1</h2>
                    <span></span>
                    <p>Breve descripcion de paso 1.<br>Breve descripcion de paso 1.</p>
                </div>
            </li>
            <li>
                <img src="images/banner02.jpg" alt="">
                <div class="flex-caption">
                    <h2>Paso 2</h2>
                    <span></span>
                    <p>Breve descripcion de paso 2.<br>Breve descripcion de paso 2.</p>
                </div>
            </li>
			<li>
                <img src="images/banner03.jpg" alt="">
                <div class="flex-caption">
                    <h2>Paso 3</h2>
                    <span></span>
                    <p>Breve descripcion de paso 3.<br>Breve descripcion de paso 3.</p>
                </div>
            </li>
        </ul>
    </div>

    <div id="services" class="section-cotent">
        <div class="container">
            <div class="title-section text-center">
                <h2>Nuestros servicios</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-eye"></i>
                            <h3><a class="black" href="/producto.php">Selección de productos</a></h3>
                        </div>
                        <div class="service-description">
                            Con nuestro modulo ecommerce podrá seleccionar su producto y editar sus rasgos a elección.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-cogs"></i>
                            <h3>Facil de pagar</h3>
                        </div>
                        <div class="service-description">
							Podrá seleccionar el metodo de pago que más le convenga.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-home"></i>
                            <h3>Recibalo en su hogar</h3>
                        </div>
                        <div class="service-description">
                            Podrá seleccionar el metodo de pago que más le convenga.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <div class="service-header">
                            <i class="fa fa-heart"></i>
                            <h3>Asesoramiento personal</h3>
                        </div>
                        <div class="service-description">
                            Podrá seleccionar el metodo de pago que más le convenga.
                        </div>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#services -->

    <div id="portfolio" class="section-content">
        <div class="container">
            <div class="title-section text-center">
                <h2>Nuestra galeria</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-1.jpg" alt="Portfolio Item 1">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-1.jpg">Albumes</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-2.jpg" alt="Portfolio Item 2">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-2.jpg">Cuadernos</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-3.jpg" alt="Portfolio Item 3">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-3.jpg">Recetarios</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-4.jpg" alt="Portfolio Item 4">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-4.jpg">Diarios de viaje</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-5.jpg" alt="Portfolio Item 5">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-5.jpg">Agendas</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-6.jpg" alt="Portfolio Item 6">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-6.jpg">Albumes</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-7.jpg" alt="Portfolio Item 7">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-7.jpg">Cuadernos</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="portfolio-thumb">
                        <img src="/img/index-buy-8.jpg" alt="Portfolio Item 8">
                        <div class="overlay">
                            <div class="inner">
                                <h4><a data-rel="lightbox" href="/img/index-buy-8.jpg">Recetarios</a></h4>
                            </div>
                        </div> 
                    </div> 
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#portfolio -->

    <div id="about" class="section-cotent">
        <div class="container">
            <div class="title-section text-center">
                <h2>Sobre nosotros</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-8">
                    <h4 class="widget-title">Estilos para usted</h4>
                    <p>Scrap Life es un taller de encuadernación artesanal que realiza todo tipo de encuadernaciones cosidas a mano combinando papeles y telas especiales. Realizamos álbumes de Recuerdos en impresión digital. Los álbumes de recuerdos realizados por SCRAP LIFE están hechos con diseño original, utilizando la técnica del Scrapbook. El scrapbook se define como un libro de recortes, es decir, la técnica de personalizar álbumes de fotografías preservando para siempre esos instantes que creamos con nuestra cámara de fotos. SCRAP LIFE adapta esta técnica al formato digital,con diseños exclusivos para armar tu álbum de Recuerdos. Impreso en papel ilustración, cosidos a mano y encuadernados artesanalmente.
					<br><br>Tenemos muchos diseños para adaptarlos a tus momentos y lo mejor es que podés agregarles una leyenda, una frase, una historia y así crear una composición de memorias... Es fácil, elegís las fotos, contás el momento y te armamos el álbum. Conservá tus recuerdos!!! Puedes visitar nuestro taller para apreciar todos los materiales que utilizamos y ver nuestros productos terminados.</p>
                </div> <!-- /.col-md-3 -->
                <div class="col-md-4 our-skills">
                    <h4 class="widget-title">Nuestros productos</h4>
                    <ul class="progess-bars">
						<?php echoProducts(); ?>
                    </ul>
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="our-team">
                    <div class="col-md-4 col-sm-6">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="/img/quienes_somos_1.jpg">
                                <div class="overlay">
                                    <ul class="social">
                                        <li><a href="#" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div> <!-- /.overlay -->
                            </div>
                        </div> <!-- /.team-member -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="/img/quienes_somos_2.jpg" alt="Mary">
                                <div class="overlay">
                                    <ul class="social">
                                        <li><a href="#" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div> <!-- /.overlay -->
                            </div>
                        </div> <!-- /.team-member -->
                    </div> <!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="/img/quienes_somos_3.jpg" alt="Julia">
                                <div class="overlay">
                                    <ul class="social">
                                        <li><a href="#" class="fa fa-facebook"></a></li>
                                        <li><a href="#" class="fa fa-twitter"></a></li>
                                        <li><a href="#" class="fa fa-instagram"></a></li>
                                    </ul>
                                </div> <!-- /.overlay -->
                            </div>
                        </div> <!-- /.team-member -->
                    </div> <!-- /.col-md-4 -->
                </div> <!-- /.our-team -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#about -->

    <div id="contact" class="section-cotent">
        <div class="container">
            <div class="title-section text-center">
                <h2>Contactanos</h2>
                <span></span>
            </div> <!-- /.title-section -->
            <div class="row">
                <div class="col-md-7 col-sm-6">
                    <h4 class="widget-title">Envianos un mensaje</h4>
                    <div class="contact-form">
                        <p class="full-row">
                            <label for="name-id">Nombre:</label>
                            <input type="text" id="name-id" name="name-id">
                        </p>
                        <p class="full-row">
                            <label for="email-id">Email:</label>
                            <input type="text" id="email-id" name="email-id">
                        </p>
                        <p class="full-row">
                            <label for="subject-id">Asunto:</label>
                            <input type="text" id="subject-id" name="subject-id">
                        </p>
                        <p class="full-row">
                            <label for="message">Mensaje:</label>
                            <textarea name="message" id="message" rows="6"></textarea>
                        </p>
                        <input class="mainBtn" type="submit" name="" value="Enviar mensaje">
                    </div>
                </div> <!-- /.col-md-3 -->
                <div class="col-md-5 col-sm-6">
                    <h4 class="widget-title">Donde estamos?</h4>
                    
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3292.720129994161!2d-58.74818499999998!3d-34.3830378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc9f8d5a4d3a9f%3A0x6cf2d38a96f11507!2sMendoza+1731%2C+B1623CSG+Ingeniero+Maschwitz%2C+Buenos+Aires!5e0!3m2!1ses!2sar!4v1437359341753" frameborder="0" style="border:0" allowfullscreen></iframe>
                    
                    <div class="contact-info">
                        <p>Vení a conocer nuestro local y todos nuestros trabajos!</p>
                        <span><i class="fa fa-home"></i>Mercado de Maschwitz - Mendoza 1731 - Ingeniero Maschwitz</span>
                        <span><i class="fa fa-phone"></i>011-4444-444</span>
                        <span><i class="fa fa-envelope"></i>info@scrap.com</span>
                    </div>
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#contact -->

    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <p>Copyright &copy; 2015 Alconan Web Dev</p>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="go-top">
                        <a href="#" id="go-top">
                            <i class="fa fa-angle-up"></i>
                            Volver al inicio
                        </a>
                    </div>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/custom.js"></script>
    
</body>
</html>