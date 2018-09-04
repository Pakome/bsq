<?php

/*** Takes as argument: $max -> the size of the biggest square.
**** 					$arr -> the original map with "." and "o"
**** 					$result -> the algorithm's array with 0's and 1's
***/
function drawBsq($max, $arr, $result) {

	global $colors;
	$first_time_max = true;

	// Go through the whole map.
	for ($i = 0; $i < count($arr); $i++) {
		for ($j = 0; $j < count($arr[$i]); $j++) {

			// Find the emplacement of the first (if there is more than one) biggest square.
			if ($result[$i][$j] == $max && $first_time_max == true) {

				// When the position is find set $first_time_max to false to prevent the function drawing multiple squares.
				$first_time_max = false;

				// It now takes the size of the biggest square and loop backwards from the position found to place it on the map.
				for ($a = 0; $a !== $max; $a++) {
					for ($b = 0; $b !== $max; $b++) {
						$arr[$i-$a][$j-$b] = "x";
					}
				} 
			}
		}
	}
	
	echo "Map filled: \n \n";

	// Draw the final map.
	foreach ($arr as $line) {
		foreach ($line as $char) {
			if ($char == "x") {
				echo $colors->getColoredString("$char ", "red", "blue");
			} else if ($char == "o") {
				echo $colors->getColoredString("$char ", "white", "blue");
			} else {
				echo $colors->getColoredString("$char ", "black", "blue");
			}
		}
		echo "\n";
	}
	echo "\n";

}

?>