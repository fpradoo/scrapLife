<?php 
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/header.php");
	include_once ($_SERVER['DOCUMENT_ROOT']."/includes/navigation.php");
?>
	<div class="index-main">
		<section class="step">
			<a href="/index.php"></a>
			<h1>Recuerdos con Historia</h1>
			<div>
				<div>
					<span>1</span>
					<p>Elegí tu cuaderno</p>
				</div>
				<div>
					<span>2</span>
					<p>Pedí el estampado</p>
				</div>
				<div>
					<span>3</span>
					<p>Recibilo en tu casa</p>
				</div>
			</div>
		</section>
		<section>
		
		<?php include_once ($_SERVER['DOCUMENT_ROOT']."/slider.php"); ?>
		</section>
		
		<section class="que-hacemos">
			<h1>¿Qué hacemos?</h1>
			<div class="text">
				<p>Scrap Life es un taller de encuadernación artesanal que realiza todo tipo de encuadernaciones cosidas a mano combinando papeles y telas especiales.
Realizamos álbumes de Recuerdos en impresión digital.
Los álbumes de recuerdos realizados por SCRAP LIFE están hechos con diseño original, utilizando la técnica del Scrapbook.
El scrapbook se define como un libro de recortes, es decir, la técnica de personalizar álbumes de fotografías preservando para siempre esos instantes que creamos con nuestra cámara de fotos.
SCRAP LIFE adapta esta técnica al formato digital,con diseños exclusivos para armar tu álbum de Recuerdos. Impreso en papel ilustración, cosidos a mano y encuadernados artesanalmente. Tenemos muchos diseños para adaptarlos a tus momentos y lo mejor es que podés agregarles una leyenda, una frase, una historia y así crear una composición de memorias...
Es fácil, elegís las fotos, contás el momento y te armamos el álbum. Conservá tus recuerdos!!!
Puedes visitar nuestro taller para apreciar todos los materiales que utilizamos y ver nuestros productos terminados.</p>
			</div>
			<div class="items-que-hacemos">
				<span>
					<h1>Cuadernos</h1>
					<img src="/img/item-index-1.jpg" />
				</span>
				<span>
					<h1>Talleres</h1>
					<img src="/img/item-index-2.jpg" />
				</span>
				<span>
					<h1>Venta online</h1>
					<img src="/img/item-index-3.jpg" />
				</span>
			</div>
		</section>
	</div>

<?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php");?>