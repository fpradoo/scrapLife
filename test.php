<?php
 $allplayerdata = array(); //M-D container array
	for ($i = 1; $i <= 11; $i++)
	{
		$playerdata = array(
		'player_id' => "aa",
		'goals' => "bb",
		'player_num' => "cc",
		'fixture_id' => "dd"
		);
		array_push($allplayerdata, $playerdata);
		
	}
	unset($allplayerdata[count($allplayerdata)-1]);
	var_dump($allplayerdata);
?>