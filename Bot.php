<?php

require_once('colorClass.php');

class Bot {

	public $colors = new Colors();

	public function __construct() {
		// Start the timer of the script
		$timestamp_start = microtime(true);
	}

	public function __destruct() {
		// Calculate the time of execution
		$timestamp_end = microtime(true);
		$difference_ms = $timestamp_end - $timestamp_start;
		echo $colors->getColoredString("Time of execution : " . $difference_ms . ' milliseconds.', "black", "green") . "\n";
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

	// Verify that the value of the first line is the map's height
	public function validatesAsInt($number) {
		global $errors;
	    $number = filter_var($number, FILTER_VALIDATE_INT);
	    if (is_int($number)) {
	    	return true;
	    } else {
	    	$errors[] = "Verify that the first line is the map's height and is an integer.";
			return false;
	    }
	}

	public function sayHello() {

return $colors->getColoredString("BBBBBBBBBBBBBBBBB      SSSSSSSSSSSSSSS      QQQQQQQQQ              SSSSSSSSSSSSSSS      OOOOOOOOO     LLLLLLLLLLL     VVVVVVVV           VVVVVVVVEEEEEEEEEEEEEEEEEEEEEERRRRRRRRRRRRRRRRR   
B::::::::::::::::B   SS:::::::::::::::S   QQ:::::::::QQ          SS:::::::::::::::S   OO:::::::::OO   L:::::::::L     V::::::V           V::::::VE::::::::::::::::::::ER::::::::::::::::R  
B::::::BBBBBB:::::B S:::::SSSSSS::::::S QQ:::::::::::::QQ       S:::::SSSSSS::::::S OO:::::::::::::OO L:::::::::L     V::::::V           V::::::VE::::::::::::::::::::ER::::::RRRRRR:::::R 
BB:::::B     B:::::BS:::::S     SSSSSSSQ:::::::QQQ:::::::Q      S:::::S     SSSSSSSO:::::::OOO:::::::OLL:::::::LL     V::::::V           V::::::VEE::::::EEEEEEEEE::::ERR:::::R     R:::::R
  B::::B     B:::::BS:::::S            Q::::::O   Q::::::Q      S:::::S            O::::::O   O::::::O  L:::::L        V:::::V           V:::::V   E:::::E       EEEEEE  R::::R     R:::::R
  B::::B     B:::::BS:::::S            Q:::::O     Q:::::Q      S:::::S            O:::::O     O:::::O  L:::::L         V:::::V         V:::::V    E:::::E               R::::R     R:::::R
  B::::BBBBBB:::::B  S::::SSSS         Q:::::O     Q:::::Q       S::::SSSS         O:::::O     O:::::O  L:::::L          V:::::V       V:::::V     E::::::EEEEEEEEEE     R::::RRRRRR:::::R 
  B:::::::::::::BB    SS::::::SSSSS    Q:::::O     Q:::::Q        SS::::::SSSSS    O:::::O     O:::::O  L:::::L           V:::::V     V:::::V      E:::::::::::::::E     R:::::::::::::RR  
  B::::BBBBBB:::::B     SSS::::::::SS  Q:::::O     Q:::::Q          SSS::::::::SS  O:::::O     O:::::O  L:::::L            V:::::V   V:::::V       E:::::::::::::::E     R::::RRRRRR:::::R 
  B::::B     B:::::B       SSSSSS::::S Q:::::O     Q:::::Q             SSSSSS::::S O:::::O     O:::::O  L:::::L             V:::::V V:::::V        E::::::EEEEEEEEEE     R::::R     R:::::R
  B::::B     B:::::B            S:::::SQ:::::O  QQQQ:::::Q                  S:::::SO:::::O     O:::::O  L:::::L              V:::::V:::::V         E:::::E               R::::R     R:::::R
  B::::B     B:::::B            S:::::SQ::::::O Q::::::::Q                  S:::::SO::::::O   O::::::O  L:::::L         LLLLLLV:::::::::V          E:::::E       EEEEEE  R::::R     R:::::R
BB:::::BBBBBB::::::BSSSSSSS     S:::::SQ:::::::QQ::::::::Q      SSSSSSS     S:::::SO:::::::OOO:::::::OLL:::::::LLLLLLLLL:::::L V:::::::V         EE::::::EEEEEEEE:::::ERR:::::R     R:::::R
B:::::::::::::::::B S::::::SSSSSS:::::S QQ::::::::::::::Q       S::::::SSSSSS:::::S OO:::::::::::::OO L::::::::::::::::::::::L  V:::::V          E::::::::::::::::::::ER::::::R     R:::::R
B::::::::::::::::B  S:::::::::::::::SS    QQ:::::::::::Q        S:::::::::::::::SS    OO:::::::::OO   L::::::::::::::::::::::L   V:::V           E::::::::::::::::::::ER::::::R     R:::::R
BBBBBBBBBBBBBBBBB    SSSSSSSSSSSSSSS        QQQQQQQQ::::QQ       SSSSSSSSSSSSSSS        OOOOOOOOO     LLLLLLLLLLLLLLLLLLLLLLLL    VVV            EEEEEEEEEEEEEEEEEEEEEERRRRRRRR     RRRRRRR
                                                    Q:::::Q                                                                                                                                
                                                     QQQQQQ", "cyan", "red") . "\n";
	}

	// Print each errors
	public function displayErrors() {
		foreach ($errors as $error) {
			echo $colors->getColoredString("There was an error: $error", "black", "red") . "\n";
		}
	}



}

?>