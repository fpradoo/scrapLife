<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/mp/lib/mercadopago.php");
$mp = new MP('8992299227915757', 'mKhyUgOgwVsrZLcPLNC6lWBelo7PIoQL');
$preference_data = array(
	"items" => array(
		array(
			"title" => "Multicolor kite",
			"quantity" => 1,
			"currency_id" => "CURRENCY_ID", // Available currencies at: https://api.mercadopago.com/currencies
			"unit_price" => 10.00
		)
	),
	"shipments" => array(
		"mode" => "me2",
		"dimensions" => "30x30x30,500",
		"local_pickup" => true,
		"free_methods" => array(
			array(
				"id" => SHIPPING_METHOD_ID
			)
		),
		"default_shipping_method" => SHIPPING_METHOD_ID,
		"zip_code" => "ZIP_CODE"
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