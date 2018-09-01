<?php

function drawBsq($max, $map) {
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

?>