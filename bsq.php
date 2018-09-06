<?php

// Start the timer of the script
$timestamp_debut = microtime(true);

include_once("algorithm.php");
include_once("colorClass.php");
include_once("frame_generator.php");
include_once("main.php");

// Initiate the variables for errors and colors
$errors = [];
$colors = new Colors();

// Check that there is the right number of arguments given
// $checkArguments = checkArgv();

// Get the map from the file and put it in an array
function getMap($numberLine, $file) {
	$arr_map = [];
	$map = fopen($file, 'r+');
	for ($i = 0; $i <= $numberLine; $i++) {
    	$line = fgets($map);
    	$full_line = str_split($line);
    	$arr_map[] = $full_line;
    }
    array_shift($arr_map);
    fclose($map);
    return $arr_map;
}

// Get the value of the first lign of the map,that the file exists and that there is no errors
function getNumberLines($file) {
	global $errors;
    if (file_exists($file)) {
        $map = fopen($file, 'r+');
        $number_of_lines = fgets($map);
        fclose($map);
        if (validatesAsInt($number_of_lines)) {
        	if(!verifyMapHeight($file, $number_of_lines)) {
        		return $number_of_lines;
        	}
        }      
 	}
    else {
        $errors[] = "The file $file does not exist.";
        return;
    }
}

// Formate the map, change "." by 1's and "o" by 0's so the algorithm can find the biggest square
function transformMap($arr) {
	$formated_map = $arr;
	for ($i = 0; $i < count($arr); $i++) {
		for ($j = 0; $j < count($arr[$i]); $j++) {
			if ($formated_map[$i][$j] == ".") {
				$formated_map[$i][$j] = preg_replace("/\./", 1, $arr[$i][$j]);
			}
			else if ($formated_map[$i][$j] == "o") {
				$formated_map[$i][$j] = preg_replace("/o/", 0, $arr[$i][$j]);
			}

		}
	}
	return $formated_map;
}

// Verify that the value of the first line is the map's height
function validatesAsInt($number) {
	global $errors;
    $number = filter_var($number, FILTER_VALIDATE_INT);
    if (is_int($number)) {
    	return true;
    } else {
    	$errors[] = "Verify that the first line is the map's height and is an integer.";
		return false;
    }
}

// Verify if an argument is provided
function checkArgv() {
	global $errors;
	global $argc;
	if ($argc == 1) {
		return 0;
	} else if ($argc > 2) {
		$errors[] = "Too much parameters given.";
		return 1;
	} else {
		return -1;
	}
}

// Verify that the first number of the file is equal to the number of lines in the file -1
function verifyMapHeight($map, $mapHeight) {
	global $errors;
	$lines = count(file($map)) - 1;
	// $mapHeight = filter_var($mapHeight, FILTER_VALIDATE_INT);
	$mapHeight = (int)$mapHeight;
	if ($lines !== $mapHeight) {
		$errors[] = "The number given on first line is not equal the real map's height: $mapHeight line(s) given, $lines found(s).";
		return false;
	}
}

// Delete every "\n" at the end of each arrays
function deleteJumpLine($arr) {
	for ($i = 0; $i < count($arr); $i++) {
		array_pop($arr[$i]);
	}
	return $arr;
}

// Display the logo
require_once("welcome.php");

// If the right number of argument was given, start the main function
if (checkArgv() == 0) {
	generateMap();
	mainFunction("map.txt");
} else if (checkArgv() == -1) {
	mainFunction($argv[1]);
}

// Print each errors
foreach ($errors as $error) {
	echo $colors->getColoredString("There was an error: $error", "black", "red") . "\n";
}

// Calculate the time of execution
$timestamp_fin = microtime(true);
$difference_ms = $timestamp_fin - $timestamp_debut;
echo $colors->getColoredString("Time of execution : " . $difference_ms . ' milliseconds.', "black", "green") . "\n";

?>