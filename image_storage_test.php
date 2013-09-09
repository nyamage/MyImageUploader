<?php

require_once("image_storage.php");

function dump($files)
{
	echo "dump file list...\n";
	foreach( $files as $file )
	{
		echo "file: $file\n";
	}	
}

$storage = new ImageStorage("./test", "image_");

$storage->store("test.jpg");

$files = $storage->files();

dump($files);

$storage->clear();

$files = $storage->files();

dump($files);

?>