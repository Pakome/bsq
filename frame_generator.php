<?php

function generateMap() {

	global $colors;

	$y = readline('Please enter the height of the map: ');
	$x = readline('Please enter the width of the map: ');
	$density = readline('Please enter the density of the map: ');

	echo "Height: $y \nWidth: $x \nDensity: $density\n";

	$map = fopen("map.txt", "w+");

	$i = 0;
	$j = 0;

	fwrite($map, "$y\n");

	while ($i < $y) {
	    $j = 0;

	    while ($j < $x) {
	    	if (rand(0, $y) * 2 < $density) {
	            fwrite($map, "o");
	        } else {
	            fwrite($map, ".");
	        }

	        $j++;
	    }

	    fwrite($map, "\n");

	    $i++;
	}

	fclose($map);
}

?>