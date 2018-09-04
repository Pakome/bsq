<?php

echo "Welcome on BSQ Solver \n";

echo "Please enter the height of the map: \n";
$y = readline('$ ');
echo "Please enter the width of the map: \n";
$x = readline('$ ');
echo "Please enter the density of the map: \n";
$density = readline('$ ');

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

?>