<?php

class Map {

	// Get the map from the file and put it in an array
	public function getMap($numberLine, $file) {
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

	// Delete every "\n" at the end of each arrays
	function deleteJumpLine($arr) {
		for ($i = 0; $i < count($arr); $i++) {
			array_pop($arr[$i]);
		}
		return $arr;
	}

}

?>