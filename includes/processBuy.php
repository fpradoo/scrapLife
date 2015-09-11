<?php
	

	$mp = new MP('8992299227915757', 'mKhyUgOgwVsrZLcPLNC6lWBelo7PIoQL');

	$preference_data = array(
		"items" => array(
			array(
				"title" => "Donación para CLUBNIVA.COM",
				"currency_id" => "ARS",
				"picture_url" =>"http://www.clubniva.com/images/logos/logo.jpg",
				"category_id" => "Donación",
				"quantity" => 1,
				"unit_price" => 100
			)
		),s
		"payer" => array(
				"name" => "Juan",
				"surname" => "Perez",
				"email" => "email@email.com"
		)	
	);
		
	$preference = $mp->create_preference($preference_data);
	?>

	<!DOCTYPE html>
	<html>
		<head>
			<title>Pay</title>
		</head>
		<body>
			<a href="<?php echo $preference['response']['init_point']; ?>">Pay</a>
		</body>
	</html>