<?php

require_once("image_helper.php");

class ThumbnailGenerator
{
	protected $m_desired_width = 0;

	function __construct($desired_width)
	{
		$this->m_desired_width = $desired_width;
	}

	public function generate($src)
	{
	//create image from source path
		$creater = $this->create_image_creater_from_file($src);
		$source_image = $creater->imagecreatefrom($src);
		if(!$source_image)
		{
			throw Exception("imagecreatefromjpeg() failed.");			
		}

	//calcurate proper height of image
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		$desired_width = $this->m_desired_width;		
		$desired_height = floor($height*($desired_width/$width));

	//create thumbnail	
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		if(!imagecopyresized($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height))
		{
			throw Exception("imagecopyresized() failed.");			
		}

		$dest = tempnam("", "thumb_");

		if(!$creater->imagecreate($virtual_image, $dest))
		{
			throw Exception("imagecreate() failed.");			
		}

		return $dest;
	}

	private function create_image_creater_from_file ($path)
	{
		list($width, $height, $type, $attr) = getimagesize($path);
		return create_image_create($type);
	}
}

?>