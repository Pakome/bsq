<?php

require_once("Bot.php");

class Map {

	public $errors = [];
	public $colors;
	public $file;
	public $max;
	public $number_of_lines;
	public $arr_map;
	public $formated_map;
	public $result;

	public function __construct($file) {
		$this->colors = new Bot();
		$this->file = $file;
	}

	public function __destruct() {
		foreach ($this->errors as $error) {
			echo $this->colors->getColoredString("There was an error: $error", "black", "red") . "\n";
		}
	}

	/*** Takes as argument: $max -> the size of the biggest square.
	**** 					$arr -> the original map with "." and "o"
	**** 					$result -> the algorithm's array with 0's and 1's
	***/
	public function drawBsq() {

		$first_time_max = true;

		// Go through the whole map.
		for ($i = 0; $i < count($this->arr_map); $i++) {
			for ($j = 0; $j < count($this->arr_map[$i]); $j++) {

				// Find the emplacement of the first (if there is more than one) biggest square.
				if ($this->result[$i][$j] == $this->max && $first_time_max == true) {

					// When the position is find set $first_time_max to false to prevent the function drawing multiple squares.
					$first_time_max = false;

					// It now takes the size of the biggest square and loop backwards from the position found to place it on the map.
					for ($a = 0; $a !== $this->max; $a++) {
						for ($b = 0; $b !== $this->max; $b++) {
							$this->arr_map[$i-$a][$j-$b] = "x";
						}
					} 
				}
			}
		}
		
		echo "Map filled: \n \n";

		// Draw the final map.
		foreach ($this->arr_map as $line) {
			foreach ($line as $char) {
				if ($char == "x") {
					echo $this->colors->getColoredString("$char ", "red", "blue");
				} else if ($char == "o") {
					echo $this->colors->getColoredString("$char ", "white", "blue");
				} else {
					echo $this->colors->getColoredString("$char ", "black", "blue");
				}
			}
			echo "\n";
		}
		echo "\n";

	}

	function defineBsq() {

		$result = $this->formated_map;
		$max = 0;
		for ($i = 0; $i < count($this->formated_map); $i++) {
			$result[$i][0] = $this->formated_map[$i][0];
			if ($result[$i][0] == 1) {
				$max = 1;
			}
		}

		for ($i = 0; $i < count($this->formated_map[0]); $i++) {
			$result[0][$i] = $this->formated_map[0][$i];
			if ($result[0][$i] == 1) {
				$max = 1;
			}
		}

		for ($i = 1; $i < count($this->formated_map); $i++) {
			for ($j = 1; $j < count($this->formated_map[$i]); $j++) {
				if ($this->formated_map[$i][$j] == 0) {
					continue;
				}

				$t = min($result[$i-1][$j], $result[$i-1][$j-1], $result[$i][$j-1]);
				$result[$i][$j] = $t + 1;

				if ($result[$i][$j] > $max) {
					$max = $result[$i][$j];
				}

			}
		}

		$this->max = $max;
		$this->result = $result;
		$this->drawBsq();
		return $this->max;
	}

	function generateMap() {

		$y = readline('Please enter the height of the map: ');
		$x = readline('Please enter the width of the map: ');
		$density = readline('Please enter the density of the map: ');

		$map = fopen($this->file, "w+");

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


	// Get the map from the file and put it in an array
	public function getMap() {
		$arr_map = [];
		$map = fopen($this->file, 'r+');
		for ($i = 0; $i <= $this->number_of_lines; $i++) {
	    	$line = fgets($map);
	    	$full_line = str_split($line);
	    	$arr_map[] = $full_line;
	    }
	    array_shift($arr_map);
	    fclose($map);
	    $this->arr_map = $this->deleteJumpLine($arr_map);
	}

	// Get the value of the first lign of the map,that the file exists and that there is no errors
	public function getNumberLines() {
	    if (file_exists($this->file)) {
	        $map = fopen($this->file, 'r+');
	        $number_of_lines = fgets($map);
	        fclose($map);
	        if ($this->validatesAsInt($number_of_lines)) {
	        	if(!$this->verifyMapHeight($this->file, $number_of_lines)) {
	        		$this->number_of_lines = $number_of_lines;
	        	}
	        }      
	 	}
	    else {
	        $this->errors[] = "The file $file does not exist.";
	        return;
	    }
	}

	// Formate the map, change "." by 1's and "o" by 0's so the algorithm can find the biggest square
	public function transformMap() {
		$formated_map = $this->arr_map;
		for ($i = 0; $i < count($this->arr_map); $i++) {
			for ($j = 0; $j < count($this->arr_map[$i]); $j++) {
				if ($formated_map[$i][$j] == ".") {
					$formated_map[$i][$j] = preg_replace("/\./", 1, $this->arr_map[$i][$j]);
				}
				else if ($formated_map[$i][$j] == "o") {
					$formated_map[$i][$j] = preg_replace("/o/", 0, $this->arr_map[$i][$j]);
				}

			}
		}
		$this->formated_map = $formated_map;
	}

	// Delete every "\n" at the end of each arrays
	public function deleteJumpLine($arr) {
		for ($i = 0; $i < count($arr); $i++) {
			array_pop($arr[$i]);
		}
		return $arr;
	}

	// Print each errors
	// public function displayErrors() {
	// 	foreach ($errors as $error) {
	// 		echo $colors->getColoredString("There was an error: $error", "black", "red") . "\n";
	// 	}
	// }

	// Verify if an argument is provided
	public function checkArgv() {
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
	public function verifyMapHeight($map, $mapHeight) {
		$lines = count(file($map)) - 1;
		// $mapHeight = filter_var($mapHeight, FILTER_VALIDATE_INT);
		$mapHeight = (int)$mapHeight;
		if ($lines !== $mapHeight) {
			$this->errors[] = "The number given on first line is not equal the real map's height: $mapHeight line(s) given, $lines found(s).";
			return false;
		}
	}

	// Verify that the value of the first line is the map's height
	public function validatesAsInt($number) {
	    $number = filter_var($number, FILTER_VALIDATE_INT);
	    if (is_int($number)) {
	    	return true;
	    } else {
	    	$this->errors[] = "Verify that the first line is the map's height and is an integer.";
			return false;
	    }
	}

}

?>