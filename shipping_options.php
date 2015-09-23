<?php
	require_once ($_SERVER['DOCUMENT_ROOT']."/mp/lib/mercadopago.php");


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shipping Cost Calculator</title>
	</head>
	<body>

		<form method="POST" action="YOUR_SERVER_URL">	
			<table>
				<thead>
					<tr>
						<th>Shipping method</th>
						<th>Estimated days</th>
						<th>Cost</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<input type='radio' name='shippingOption' id='0' value='0'>
							<label for='taller'>Retiro por taller</label>
						</td>
						<td>
						</td>
						<td>
							0
						</td>
					</tr>
					<?php
					
					$shipping_options = $response['response']['options'];

					foreach($shipping_options as $shipping_option) {

						$value = $shipping_option['shipping_method_id'];
						$name = $shipping_option['name'];
						$checked = $shipping_option['display'] == "recommended" ? "checked='checked'" : "";

						$shipping_speed = $shipping_option['speed']['shipping'];
						$estimated_delivery = $shipping_speed < 24 ? 1 : ceil($shipping_speed / 24); //from departure, estimated delivery time

						$cost = $shipping_option['cost'];
						$cost = $cost == 0 ? "FREE" : "$$cost";

					?>
					<tr>
						<td>
							<input type='radio' name='shippingOption' id='<?=$value;?>' value='<?=$value;?>' <?=$checked;?>>
							<label for='<?=$value;?>'><?=$name;?></label>
						</td>
						<td>
							<?=$estimated_delivery;?>
						</td>
						<td>
							<?=$cost;?>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<input type="submit">
		</form>
	</body>
</html>