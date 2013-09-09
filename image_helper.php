<?php

interface IImageCreate
{
	public function imagecreatefrom($path);
	public function imagecreate($resource, $path);	
}

class JpegImageCreate implements IImageCreate
{
	public function imagecreatefrom($path){ return imagecreatefromjpeg($path); }
	public function imagecreate($resource, $path) { return imagejpeg($resource, $path); }
}

class PngImageCreate implements IImageCreate
{
	public function imagecreatefrom($path){ return imagecreatefrompng($path); }
	public function imagecreate($resource, $path) { return imagepng($resource, $path); }
}

class GifImageCreate implements IImageCreate
{
	public function imagecreatefrom($path){ return imagecreatefromgif($path); }
	public function imagecreate($resource, $path) { return imagegif($resource, $path); }
}

function create_image_create ($type)
{
	$image_create = NULL;
	switch($type)
	{
		case IMAGETYPE_JPEG:
			$image_create = new JpegImageCreate();
			break;
		case IMAGETYPE_PNG:
			$image_create = new PngImageCreate();		
			break;
		case IMAGETYPE_GIF:
			$image_create = new GifImageCreate();				
			break;		
		default:
			break;
	}

	return $image_create;
}

?>