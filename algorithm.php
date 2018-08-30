<?php

function defineBsq($arr) {

	$result = $arr;
	$max;
	for ($i = 0; $i < count($arr); $i++) {
		$result[$i][0] = $arr[$i][0];
		if ($result[$i][0] == 1) {
			$max = 1;
		}
	}

	for ($i = 0; $i < count($arr[0]); $i++) {
		$result[0][$i] = $arr[0][$i];
		if ($result[0][$i] == 1) {
			$max = 1;
		}
	}

	for ($i = 1; $i < count($arr); $i++) {
		for ($j = 1; $j < count($arr[$i]); $j++) {
			if ($arr[$i][$j] == 0) {
				continue;
			}

			$t = min($result[$i-1][$j], $result[$i-1][$j-1], $result[$i][$j-1]);
			$result[$i][$j] = $t + 1;

			if ($result[$i][$j] > $max) {
				$max = $result[$i][$j];
			}

		}
	}
	return $max;

}

// Create the map
// 01101
// 11111
// 01111
// 11111
// 11111
// 00000
$arr = array (
	array(0, 1, 1, 0, 1),
	array(1, 1, 1, 1, 0),
	array(0, 1, 1, 1, 1),
	array(1, 1, 1, 1, 1),
	array(1, 1, 1, 1, 1),
	array(0, 0, 0, 0, 0)
);

// echo defineBsq($arr);

?>