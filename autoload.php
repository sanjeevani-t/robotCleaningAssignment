<?php
$fileList = scandir(__DIR__,  SCANDIR_SORT_DESCENDING);

foreach ($fileList as $value) {
	$value1 = __DIR__ . DIRECTORY_SEPARATOR . $value;
	if( is_file($value1) )
	{
		if (preg_match("/(.*.php)/i", $value)) {
			if($value != "index.php"){
				include_once $value1;
			}
		}
	}
}

$srcFileList = scandir(__DIR__."\src",  SCANDIR_SORT_DESCENDING);
foreach ($srcFileList as $value) {
	$value1 = __DIR__ ."\src". DIRECTORY_SEPARATOR . $value;
	if( is_dir($value1) && strlen($value)>3)
	{
		foreach (glob("{$value1}\*.php") as $filename)
	    {
	        include $filename;
	    }
	}
}

?>
