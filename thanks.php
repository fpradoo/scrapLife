<?php 
	include_once ($_SERVER['DOCUMENT_ROOT']."/core/functions.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
	getSeccionProductosById();
	deleteSession();
	checkProductosFinalizado();
?>

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
		</div>
	</div>
	<div id='productoCompleto'>
	</div>
	

<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php");
?>		
</body>
	
