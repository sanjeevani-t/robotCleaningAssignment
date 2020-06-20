<?php

$fileList = scandir(__DIR__,  SCANDIR_SORT_DESCENDING);

foreach ($fileList as $value) {
	$value1 = __DIR__ . DIRECTORY_SEPARATOR . $value;
	if( is_file($value1) ){
		if (preg_match("/(.*.php)/i", $value)) {
			if($value != "index.php"){
				include_once $value1;
			}
		}
	}
}

?>
