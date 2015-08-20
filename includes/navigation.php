<?php
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");
?>
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
		});
	</script>
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
            <div class="main-header" style='position:relative'>
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
                                    <li><a href="/index.php#home">Home</a></li>
									<li><a class="pointer" id='prod' onclick="OpenInNewTab('/producto.php')" onmouseup="OpenInNewTab('/producto.php')">Productos</a></li>
									<li><a href="/index.php#services">Servicios</a></li>
                                    <li><a href="/index.php#portfolio">Galeria</a></li>
                                    <li><a href="/index.php#about">Sobre nosotros</a></li>
                                    <li><a href="/index.php#contact">Contacto</a></li>
                                </ul>
                            </div> 
                        </div> 
                    </div>
                </div> <!-- /.container -->
            </div> <!-- /.header -->
        </div> <!-- /.site-header -->
    </div>