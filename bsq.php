<?php

// Start the timer of the script
$timestamp_start = microtime(true);

include_once("Map.php");
include_once("Bot.php");

// Initiate a new instance of Bot;
$bot = new Bot();

// Display the logo
echo $bot->sayHello();
$arg = $bot->checkArgv();

if ($arg < 2 && $arg == 1) {
	$choice = $bot->displayCommands();
	if ($choice !== false) {
		if ($choice == -1) {
			$map = new Map('map.txt');
			$map->generateMap();
			$numberOfLines = $map->getNumberLines();
			$arr_map = $map->getMap();
			$formated_map = $map->transformMap();
			echo $bot->getColoredString("The biggest square is " . $map->defineBsq() . " tiles larges." , "black", "green") . "\n";
		} else {
			$map = new Map($choice);
			$numberOfLines = $map->getNumberLines();
			$arr_map = $map->getMap();
			$formated_map = $map->transformMap();
			echo $bot->getColoredString("The biggest square is " . $map->defineBsq() . " tiles larges." , "black", "green") . "\n";
		}
	}
} else if ($arg == 2) {
	$map = new Map($argv[1]);
	$numberOfLines = $map->getNumberLines();
	$arr_map = $map->getMap();
	$formated_map = $map->transformMap();
	echo $bot->getColoredString("The biggest square is " . $map->defineBsq() . " tiles larges." , "black", "green") . "\n";
}

// Calculate the time of execution
$difference_ms = microtime(true) - $timestamp_start;
echo $bot->getColoredString("Time of execution : " . $difference_ms . ' milliseconds.', "black", "green") . "\n";

?>