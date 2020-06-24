<?php
// To use composer in core PHP, you'll need to include autoload. php
include_once 'autoload.php';
use App\Command\RobotCommand;

if( !isset($argv[1]) || !isset($argv[2]) || !isset($argv[3]) ){
	echo "Please  empty";
	exit;	
}

$floor = explode("=", $argv[2]);
$area = explode("=", $argv[3]);

// Create Object of RobotCommand
$robot = new RobotCommand();
$robot->run(strtolower($floor[1]), $area[1]);