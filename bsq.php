<?php

// Initiate the variables for errors
$errors = [];

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
function getNumberLigns($file) {
	global $errors;
    if (file_exists($file)) {
        $map = fopen($file, 'r+');
        $number_of_lines = fgets($map);
        fclose($map);
        if (validatesAsInt($number_of_lines)) {
        	if(!verifyMapHeight($file, $number_of_lines)) {
        		var_dump($number_of_lines);
        		return $number_of_lines;
        	}
        }      
 	}
    else {
        $errors[] = "The file $file does not exist.";
        return;
    }
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
	if ($argc < 2) {
		$errors[] = "You need to put a map to work with.";
		return false;
	} else if ($argc > 2) {
		$errors[] = "Too much parameters given.";
		return false;
	}
}

// Verify that the first number of the file is equal to the number of lines in the file -1
function verifyMapHeight($map, $mapHeight) {
	global $errors;
	$lines = count(file($map)) - 1;
	// $mapHeight = filter_var($mapHeight, FILTER_VALIDATE_INT);
	$mapHeight = (int)$mapHeight;
	if ($lines !== $mapHeight) {
		$errors[] = "The number given on first line is not equal the real map's height: $mapHeight line(s) given, $lines found(s)";
		return false;
	}
}

// If the right number of argument was given, start the main function
if ($checkArguments !== false) {
	$numberOfLines = getNumberLigns($argv[1]);
}

$arr_map = getMap($numberOfLines);
print_r($arr_map);

// Print each errors
foreach ($errors as $error) {
	echo "There was an error: $error \n";
}

?>