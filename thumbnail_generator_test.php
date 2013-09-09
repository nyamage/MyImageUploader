<?php

require_once("thumbnail_generator.php");

$generator = new ThumbnailGenerator(50);

$generator->generate("test.jpg", "thumbnail_test.jpg");

?>