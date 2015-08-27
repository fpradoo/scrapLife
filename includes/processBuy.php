<?php
	require_once ($_SERVER['DOCUMENT_ROOT']."/mp/lib/mercadopago.php");

	$mp = new MP('8992299227915757', 'mKhyUgOgwVsrZLcPLNC6lWBelo7PIoQL');

	$preference_data = array(
		"items" => array(
			array(
				"title" => "Multicolor kite",
				"quantity" => 1,
				"currency_id" => "ARS", // Available currencies at: https://api.mercadopago.com/currencies
				"unit_price" => 10.00
			)
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