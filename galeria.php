<?php 
	include_once ("/includes/header.php");
	include_once ("/includes/navigation.php");
?>

	<div class="galery-main">
		<div>
			<span class="text">
				<h1>Galería</h1>
				<select name="item-choise">
					<option value="1">Item</option>
					<option value="2">Item</option>
					<option value="3">Item</option>
				</select>
				<p>Los cuadernos están realizados con papel bookcel de 80 gr. Cosidos a mano y encuadernados artesanalmente. Los cuadernos personalizados son exclusivos y diseñados especialmente para vos.</p>
			</span>
		</div>
		<div>
			<div class="container">
				<div id="slides">
				  <img src="img/slider.jpg" alt="#">
				  <img src="img/slider.jpg" alt="#">
				  <img src="img/slider.jpg" alt="#">
				  <img src="img/slider.jpg" alt="#">
				  <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
				  <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
				</div>
			  </div>
			</div>
	</div>

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="js/jquery.slides.min.js"></script>

	<script>
		$(function() {
		$('#slides').slidesjs({
			width: 940,
			height: 528,
			navigation: false
			});
		});
	</script>

<?php include_once("/includes/footer.php");?>