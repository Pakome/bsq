<?php

function mainFunction($file) {

	global $colors;
	$numberOfLines = getNumberLines($file);

	// Loop through the map file and put each character in an array
	$arr_map = getMap($numberOfLines, $file);

	// Delete the blank at the end of each arrays
	$arr_map = deleteJumpLine($arr_map);

	// Transform the map in 0's and 1's
	$formated_map = (transformMap($arr_map));

	// Let the user know the size of the biggest square
	echo $colors->getColoredString("The biggest square is " . defineBsq($formated_map, $arr_map) . " tiles larges." , "black", "green") . "\n";
}
?>