<?php

require_once("thumbnail_generator.php");
require_once("image_storage.php");
require_once("view_helper.php");

define("IMAGE_DIR", "./test");
define("IMAGE_PREFIX", "image_");
define("THUMBNAIL_DIR", "./test");
define("THUMBNAIL_PREFIX", "thumbnail_");

function HandleImageUpload($uploaded_file)
{
	$image_directory = IMAGE_DIR;
	$image_prefix = IMAGE_PREFIX;
	$thumbnail_directory = THUMBNAIL_DIR;
	$thumbnail_prefix = THUMBNAIL_PREFIX;

	$storage = new ImageStorage($image_directory, $image_prefix);

	$image = $storage->store($uploaded_file);

	$thumbnail_generator = new ThumbnailGenerator(100);
	$thumbnail = $thumbnail_generator->generate($image);

	$thumbnail_storage = new ImageStorage($thumbnail_directory, $thumbnail_prefix);
	$thumb_image = $thumbnail_storage->store($thumbnail);
	$thumb_image = basename($thumb_image);
	$response = array( "result" => "ok", "image" => "$thumbnail_directory/$thumb_image" );
	output_view_file("image_upload_result_view.html", $response);	
}

$uploaded_file = $_FILES["picture"]["tmp_name"];

if( is_uploaded_file($uploaded_file) )
{
	HandleImageUpload($uploaded_file);
}
else
{
	$thumbnail_directory = IMAGE_DIR;
	$thumbnail_prefix = THUMBNAIL_PREFIX;
	$thumbnail_storage = new ImageStorage($thumbnail_directory, $thumbnail_prefix);
	output_view_file("image_upload_view.html", $thumbnail_storage->files());
}

?>
