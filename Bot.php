<?php

class Bot {

	private $errors = [];
	private $foreground_colors = array();
	private $background_colors = array();

	public function __construct($primary_map_color = "black", $background_map_color = "blue", $square_color = "red") {
		// Set up shell colors
		$this->foreground_colors['black'] = '0;30';
		$this->foreground_colors['dark_gray'] = '1;30';
		$this->foreground_colors['blue'] = '0;34';
		$this->foreground_colors['light_blue'] = '1;34';
		$this->foreground_colors['green'] = '0;32';
		$this->foreground_colors['light_green'] = '1;32';
		$this->foreground_colors['cyan'] = '0;36';
		$this->foreground_colors['light_cyan'] = '1;36';
		$this->foreground_colors['red'] = '0;31';
		$this->foreground_colors['light_red'] = '1;31';
		$this->foreground_colors['purple'] = '0;35';
		$this->foreground_colors['light_purple'] = '1;35';
		$this->foreground_colors['brown'] = '0;33';
		$this->foreground_colors['yellow'] = '1;33';
		$this->foreground_colors['light_gray'] = '0;37';
		$this->foreground_colors['white'] = '1;37';

		$this->background_colors['black'] = '40';
		$this->background_colors['red'] = '41';
		$this->background_colors['green'] = '42';
		$this->background_colors['yellow'] = '43';
		$this->background_colors['blue'] = '44';
		$this->background_colors['magenta'] = '45';
		$this->background_colors['cyan'] = '46';
		$this->background_colors['light_gray'] = '47';
	}

	public function __destruct() {
		foreach ($this->errors as $error) {
			echo $this->getColoredString("There was an error: $error", "black", "red") . "\n";
		}
	}

	// Verify if an argument is provided
	public function checkArgv() {
		global $argc;
		if ($argc == 1) {
			return 1;
		} else if ($argc == 2) {
			return 2;
		} else if ($argc > 2) {
			$this->errors[] = "too much parameters given.";
			return 3;
		}
	}

	// Returns colored string
	public function getColoredString($string, $foreground_color = null, $background_color = null) {
		$colored_string = "";

		// Check if given foreground color found
		if (isset($this->foreground_colors[$foreground_color])) {
			$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
		}
		// Check if given background color found
		if (isset($this->background_colors[$background_color])) {
			$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
		}

		// Add string and end coloring
		$colored_string .=  $string . "\033[0m";

		return $colored_string;
	}

	// Returns all foreground color names
	public function getForegroundColors() {
		return array_keys($this->foreground_colors);
	}

	// Returns all background color names
	public function getBackgroundColors() {
		return array_keys($this->background_colors);
	}

	// Diplay Commands 
	public function displayCommands() {
		$welcome = readline("Welcome on BSQ Solver® press any character to continue or 'enter' quit to exit the program. \n");
		if ($welcome == "quit" || $welcome == "q") {
			return false;
		}
		$choice = readline("You can either solve an existing map or generate your own map:\n\n    -Enter the name of your existing map to solve it.\n    -Press enter to generater your own.\n\n$ ");
		if ($choice == "") {
			return -1;
		} else {
			return $choice;
		}
	}

	public function sayHello() {

return $this->getColoredString("BBBBBBBBBBBBBBBBB      SSSSSSSSSSSSSSS      QQQQQQQQQ              SSSSSSSSSSSSSSS      OOOOOOOOO     LLLLLLLLLLL     VVVVVVVV           VVVVVVVVEEEEEEEEEEEEEEEEEEEEEERRRRRRRRRRRRRRRRR   
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
                                                     QQQQQQ", "cyan", "red") . "\n \n \n";
	}

}

?>