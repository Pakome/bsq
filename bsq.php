<?php

// Start the timer of the script
$timestamp_debut = microtime(true);

include_once('algorithm.php');
include_once("colorClass.php");

// Initiate the variables for errors and colors
$errors = [];
$colors = new Colors();

// Check that there is the right number of arguments given
$checkArguments = checkArgv();

// Get the map from the file and put it in an array
function getMap($numberLine) {
	global $argv;
	$arr_map = [];
	$map = fopen($argv[1], 'r+');
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
	if ($argc = 1) {
		return "user generated map";
	} else if ($argc > 2) {
		$errors[] = "Too much parameters given.";
		return false;
	} else {
		return true;
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

// If the right number of argument was given, return the numbers of lines of the map
if ($checkArguments == "user generated map") {
	echo "Mode auto";
} else if ($checkArguments !== false) {
	$numberOfLines = getNumberLines($argv[1]);
}

// Display the logo
require_once("welcome.php");

// Loop through the map file and put each character in an array
$arr_map = getMap($numberOfLines);

// Delete the blank at the end of each arrays
$arr_map = deleteJumpLine($arr_map);

// Transform the map in 0's and 1's
$formated_map = (transformMap($arr_map));

// Let the user know the size of the biggest square
echo $colors->getColoredString("The biggest square is " . defineBsq($formated_map, $arr_map) . " tiles larges." , "black", "green") . "\n";

// Print each errors
foreach ($errors as $error) {
	echo $colors->getColoredString("There was an error: $error", "black", "red") . "\n";
}

// Calculate the time of execution
$timestamp_fin = microtime(true);
$difference_ms = $timestamp_fin - $timestamp_debut;
echo $colors->getColoredString("Time of execution : " . $difference_ms . ' seconds.', "black", "green") . "\n";

?>