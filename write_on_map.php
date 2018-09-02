<?php

function drawBsq($max, $arr, $result) {

	$first_time_max = true;

	for ($i = 0; $i < count($arr); $i++) {
		for ($j = 0; $j < count($arr[$i]); $j++) {
			if ($result[$i][$j] == $max && $first_time_max == true) {
				$first_time_max = false;
				for ($a = 0; $a !== $max; $a++) {
					for ($b = 0; $b !== $max; $b++) {
						$arr[$i-$a][$j-$b] = "x";
					}
				} 
			}
		}
	}
	
	echo "Map filled: \n \n";

	foreach ($arr as $line) {
		foreach ($line as $char) {
			echo "$char";
		}
		echo "\n";
	}

}

?>